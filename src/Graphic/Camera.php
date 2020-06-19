<?php

declare(strict_types=1);

namespace Mammoth\Graphic;

use Mammoth\Math\Angle;
use Mammoth\Math\Transform;
use Mammoth\Math\Vector;

/**
 * A camera class that processes input and calculates the corresponding Eular Angles, Vectors and Matrices for use in OpenGL
 */
class Camera
{
    const FORWARD = 0;
    const BACKWARD = 1;
    const LEFT = 2;
    const RIGHT = 3;

    // Camera Attributes
    public $position;
    public $front;
    public $up;
    public $right;
    public $worldUp;

    // Eular Angles
    public $yaw;
    public $pitch;

    // Camera options
    public $MovementSpeed;
    public $MouseSensitivity;
    public $zoom;

    // Constructor with vectors
    public function __construct(Vector $position = null, Vector $up = null, $yaw = -90, $pitch = 0)
    {

        if (null === $position) {
            $position = new Vector(0.0, 0.0, 0.0);
        }
        if (null === $up) {
            $up = new Vector(0.0, 1.0, 0.0);
        }

        $this->front = new Vector(0.0, 0.0, -1.0);
        $this->MovementSpeed = 3;
        $this->MouseSensitivity = 0.25;
        $this->zoom = 45;
        $this->position = $position;
        $this->worldUp = $up;
        $this->yaw = $yaw;
        $this->pitch = $pitch;
        $this->updateVectors();
    }

    /**
     * Returns the view matrix calculated using Eular Angles and the LookAt Matrix
     */
    public function getViewMatrix()
    {
        return Transform::lookAt($this->position, $this->position->add($this->front), $this->up);
    }

    /**
     * Processes input received from any keyboard-like input system. Accepts input parameter in the form of camera defined ENUM (to abstract it from windowing systems)
     */
    public function processKeyboard($direction, $deltaTime)
    {
        $velocity = $this->MovementSpeed * $deltaTime;
        if ($direction == self::FORWARD)
            $this->position = $this->position->add($this->front->scale($velocity));
        if ($direction == self::BACKWARD)
            $this->position = $this->position->substract($this->front->scale($velocity));
        if ($direction == self::LEFT)
            $this->position = $this->position->substract($this->right->scale($velocity));
        if ($direction == self::RIGHT)
            $this->position = $this->position->add($this->right->scale($velocity));
    }

    /**
     * Processes input received from a mouse input system. Expects the offset value in both the x and y direction.
     */
    public function processMouseMovement($xoffset, $yoffset, $constrainPitch = true)
    {
        $xoffset *= $this->MouseSensitivity;
        $yoffset *= $this->MouseSensitivity;

        $this->yaw   += $xoffset;
        $this->pitch += $yoffset;

        // Make sure that when pitch is out of bounds, screen doesn't get flipped
        if ($constrainPitch) {
            if ($this->pitch > 89.0)
                $this->pitch = 89.0;
            if ($this->pitch < -89.0)
                $this->pitch = -89.0;
        }

        // Update front, right and up Vectors using the updated Eular angles
        $this->updateVectors();
    }

    /**
     * Processes input received from a mouse scroll-wheel event. Only requires input on the vertical wheel-axis
     */
    public function processMouseScroll($yoffset)
    {
        if ($this->zoom >= 1.0 && $this->zoom <= 45.0)
            $this->zoom -= $yoffset;
        if ($this->zoom <= 1.0)
            $this->zoom = 1.0;
        if ($this->zoom >= 45.0)
            $this->zoom = 45.0;
    }

    /**
     * Calculates the front vector from the Camera's (updated) Eular Angles
     */
    public function updateVectors()
    {
        // Calculate the new front vector
        $front = new Vector;
        $front->x = cos(Angle::toRadians($this->yaw)) * cos(Angle::toRadians($this->pitch));
        $front->y = sin(Angle::toRadians($this->pitch));
        $front->z = sin(Angle::toRadians($this->yaw)) * cos(Angle::toRadians($this->pitch));
        $this->front = $front->normalize();
        // Also re-calculate the right and up vector
        $this->right = $this->front->cross($this->worldUp)->normalize();

        // Normalize the vectors, because their length gets closer to 0 the more you look up or down which results in slower movement.
        $this->up = $this->right->cross($this->front)->normalize();
    }
}

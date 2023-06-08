<?php 

namespace App\Traits\factories;

/**
 * Used for Factory classes
 */

trait StatusableFactory
{
    /**
     * Indicate that the model's status should be inactive
     */
    public function inactive()
    {
        return $this->state(fn () => [
            'active' => 0,
        ]);
    }

}
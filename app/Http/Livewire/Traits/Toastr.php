<?php

namespace App\Http\Livewire\Traits;

trait Toastr
{
    /**
     * Success Toast
     *
     * @param $text
     * @return void
     */
    public function success($text): void
    {
        $this->emit('toastr', ['status' => 'success', 'text' => $text]);
    }

    /**
     * Error Toast
     *
     * @param $text
     * @return void
     */
    public function error($text): void
    {
        $this->emit('toastr', ['status' => 'error', 'text' => $text]);
    }

    /**
     * Warning Toast
     *
     * @param $text
     * @return void
     */
    public function warning($text): void
    {
        $this->emit('toastr', ['status' => 'warning', 'text' => $text]);
    }

    /**
     * Info Toast
     *
     * @param $text
     * @return void
     */
    public function info($text): void
    {
        $this->emit('toastr', ['status' => 'info', 'text' => $text]);
    }
}

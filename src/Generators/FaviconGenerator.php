<?php

namespace LukasMu\Favicon\Generators;

use Intervention\Image\Image;

abstract class FaviconGenerator
{
    public function __construct(
        protected int $width,
        protected int $height,
        protected bool $maskable
    ) {}

    abstract public function image(): Image;

    protected function getWidth(): int
    {
        return $this->width;
    }

    protected function getHeight(): int
    {
        return $this->height;
    }

    protected function isMaskable(): bool
    {
        return $this->maskable;
    }

    protected function getText(): string
    {
        return config('favicon.text');
    }

    protected function getFont(): string
    {
        return config('favicon.font');
    }

    protected function getColor(): string
    {
        return config('favicon.colors.text');
    }

    protected function getBackgroundColor(): string
    {
        return config('favicon.colors.background');
    }

    protected function getPadding(): int
    {
        return intval(round(config('favicon.padding') * min($this->height, $this->width) / 100));
    }

    protected function getMargin(): int
    {
        return intval(round(config('favicon.margin') * min($this->height, $this->width) / 100));
    }

    protected function getBorderRadius(): int
    {
        return intval(round(config('favicon.border_radius') * min($this->height, $this->width) / 100));
    }
}

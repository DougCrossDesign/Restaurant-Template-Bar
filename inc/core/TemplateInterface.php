<?php

/**
 * Interface TemplateInterface
 *
 * Contains methods that all Templates or template types require
 */
interface TemplateInterface
{
    /**
     * Renders the Template files and returns formatted HTML
     * @return string   Rendered HTML
     */
    public function render();

    /**
     * Sets the theme
     *
     * @param $theme    The name of the theme (folder) to use
     *
     * @return string   Rendered HTML
     */
    public function setTheme($theme);
}
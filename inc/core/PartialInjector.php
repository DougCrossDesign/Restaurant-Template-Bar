<?php
use Model\Pages\Partial;
use Model\PartialModel;

interface PartialInjector
{
    /**
     * =========== PARTIAL MODEL METHODS (the main partial... not the meta children)
     */

    /**
     * @param Partial $model
     *
     * This hook is useful to check the current / previous values of this model, in case we want to compare with what our new values are
     *
     * @return mixed
     */
    public static function preUpdate($model);

    /**
     * @param Partial $model
     *
     * This hook is fired after the model has been updated with the new values, but before we actually save
     * This is useful to compare with what our old values were if we stored them in the preUpdate method, to act on
     *
     * @return mixed
     */
    public static function preSave($model);

    /**
     * @param Partial $model
     *
     * This hook is fired after the changes have been saved to the database
     *
     * @return mixed
     */
    public static function postSave($model);

    /**
     * ========== PARTIAL META MODEL METHODS (the meta children)
     */

    /**
     * @param PartialModel $model
     *
     * This hook is useful to check the current / previous values of this meta model, in case we want to compare with what our new values are
     *
     * @return mixed
     */
    public static function preUpdateMeta($model);

    /**
     * @param PartialModel $model
     *
     * This hook is fired after the model has been updated with the new values, but before we actually save
     * This is useful to compare with what our old values were if we stored them in the preUpdate method, to act on
     *
     * @return mixed
     */
    public static function preSaveMeta($model);

    /**
     * @param PartialModel $model
     *
     * This hook is fired after the changes have been saved to the database
     *
     * @return mixed
     */
    public static function postSaveMeta($model);

    //TODO Care to explain?
    public static function preRender($model);

    //TODO Why was this commented out ?
    //public static function duringRender($model);

    //TODO Care to explain?
    public static function postRender($model);

}
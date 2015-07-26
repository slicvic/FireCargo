<?php namespace App\Presenters;

use Illuminate\Database\Eloquent\Model;

/**
 * BasePresenter
 *
 * @author Victor Lantigua <vmlantigua@gmail.com>
 */
abstract class BasePresenter {

    /**
     * The model instance.
     *
     * @var Model
     */
    protected $model;

    /**
     * Constructor.
     *
     * @param Model  $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Presents the created datetime along with the creator's name.
     *
     * @return string
     */
    public function createdAt()
    {
        $createdAt = date('m/d/y g:i A', strtotime($this->model->created_at));

        $createdBy = ($this->model->creator_user_id) ? ' by ' . $this->model->creator->present()->fullname() : '';

        return $createdAt . $createdBy;
    }

    /**
     * Presents the updated datetime along with the updater's name.
     *
     * @return string
     */
    public function updatedAt()
    {
        $updatedAt = date('m/d/y g:i A', strtotime($this->model->updated_at));

        $updatedBy = ($this->model->updater_user_id) ? ' by ' . $this->model->updater->present()->fullname() : '';

        return $updatedAt . $updatedBy;
    }
}

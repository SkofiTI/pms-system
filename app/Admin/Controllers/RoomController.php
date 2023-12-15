<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Room;

class RoomController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Room';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Room());

        $grid->column('room_id', __('Room id'));
        $grid->column('category_id', __('Category id'));
        $grid->column('floor', __('Floor'));
        $grid->column('square', __('Square'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Room::findOrFail($id));

        $show->field('room_id', __('Room id'));
        $show->field('category_id', __('Category id'));
        $show->field('floor', __('Floor'));
        $show->field('square', __('Square'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Room());

        $form->number('room_id', __('Room id'));
        $form->number('category_id', __('Category id'));
        $form->number('floor', __('Floor'));
        $form->number('square', __('Square'));

        return $form;
    }
}

<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Reservation;

class ReservationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Reservation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reservation());

        $grid->column('reserv_id', __('Reserv id'));
        $grid->column('room_id', __('Room id'));
        $grid->column('date_in', __('Date in'));
        $grid->column('date_out', __('Date out'));
        $grid->column('status', __('Status'));
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
        $show = new Show(Reservation::findOrFail($id));

        $show->field('reserv_id', __('Reserv id'));
        $show->field('room_id', __('Room id'));
        $show->field('date_in', __('Date in'));
        $show->field('date_out', __('Date out'));
        $show->field('status', __('Status'));
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
        $form = new Form(new Reservation());

        $form->number('reserv_id', __('Reserv id'));
        $form->number('room_id', __('Room id'));
        $form->datetime('date_in', __('Date in'))->default(date('Y-m-d H:i:s'));
        $form->datetime('date_out', __('Date out'))->default(date('Y-m-d H:i:s'));
        $form->text('status', __('Status'));

        return $form;
    }
}

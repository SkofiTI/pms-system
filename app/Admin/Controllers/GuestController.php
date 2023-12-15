<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Guest;

class GuestController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Guest';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Guest());

        $grid->column('id', __('Id'));
        $grid->column('reserv_id', __('Reserv id'));
        $grid->column('name', __('Name'));
        $grid->column('surname', __('Surname'));
        $grid->column('patronymic', __('Patronymic'));
        $grid->column('address', __('Address'));
        $grid->column('number', __('Number'));
        $grid->column('passport', __('Passport'));
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
        $show = new Show(Guest::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('reserv_id', __('Reserv id'));
        $show->field('name', __('Name'));
        $show->field('surname', __('Surname'));
        $show->field('patronymic', __('Patronymic'));
        $show->field('address', __('Address'));
        $show->field('number', __('Number'));
        $show->field('passport', __('Passport'));
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
        $form = new Form(new Guest());

        $form->number('reserv_id', __('Reserv id'));
        $form->text('name', __('Name'));
        $form->text('surname', __('Surname'));
        $form->text('patronymic', __('Patronymic'));
        $form->text('address', __('Address'));
        $form->text('number', __('Number'));
        $form->text('passport', __('Passport'));

        return $form;
    }
}

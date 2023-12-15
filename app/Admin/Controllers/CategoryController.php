<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Category;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('category_id', __('Category id'));
        $grid->column('name', __('Name'));
        $grid->column('price', __('Price'));
        $grid->column('count_room', __('Count room'));
        $grid->column('max_capacity', __('Max capacity'));
        $grid->column('conditioner', __('Conditioner'));
        $grid->column('tv', __('Tv'));
        $grid->column('smoke', __('Smoke'));
        $grid->column('balcony', __('Balcony'));
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
        $show = new Show(Category::findOrFail($id));

        $show->field('category_id', __('Category id'));
        $show->field('name', __('Name'));
        $show->field('price', __('Price'));
        $show->field('count_room', __('Count room'));
        $show->field('max_capacity', __('Max capacity'));
        $show->field('conditioner', __('Conditioner'));
        $show->field('tv', __('Tv'));
        $show->field('smoke', __('Smoke'));
        $show->field('balcony', __('Balcony'));
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
        $form = new Form(new Category());

        $form->number('category_id', __('Category id'));
        $form->text('name', __('Name'));
        $form->decimal('price', __('Price'));
        $form->switch('count_room', __('Count room'));
        $form->switch('max_capacity', __('Max capacity'));
        $form->switch('conditioner', __('Conditioner'));
        $form->switch('tv', __('Tv'));
        $form->switch('smoke', __('Smoke'));
        $form->switch('balcony', __('Balcony'));

        return $form;
    }
}

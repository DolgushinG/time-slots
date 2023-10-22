<?php

namespace App\Admin\Controllers;

use App\Service;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ServicesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Service';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Service());

//        $grid->column('id', __('Id'));
        $grid->column('name_service', __('Услуга'))->editable('text');
        $grid->column('price', __('Цена'))->editable('text');
//        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));
//        $grid->column('deleted_at', __('Deleted at'));

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
        $show = new Show(Service::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name_service', __('Услуга'));
        $show->field('price', __('Цена'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Service());

        $form->text('name_service', __('Услуга'));
        $form->text('Price', __('Цена'));

        return $form;
    }
}

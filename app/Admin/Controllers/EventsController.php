<?php

namespace App\Admin\Controllers;

use App\Event;
use App\Service;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EventsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Event';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Event());

//        $grid->column('id', __('Id'));
        $grid->column('name', __('Имя'))->editable();
        $grid->column('phone', __('Телефон'))->editable();
        $grid->column('start_time', __('Дата и время'));
//        $grid->column('date', __('Date'));
//        $grid->column('end_time', __('End time'));
//        $grid->column('name_service');
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
        $show = new Show(Event::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Имя'));
        $show->field('phone', __('Телефон'));
        $show->field('start_time', __('Дата и Время'));
        $show->field('date', __('Дата'));
        $show->field('end_time', __('Дата и время окончание записи'));
        $show->field('name_service', __('Услуга'));
        $show->field('created_at', __('Создана'));
        $show->field('updated_at', __('Обновлена'));
        $show->field('deleted_at', __('Удалена'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Event());

        $form->text('name', __('Имя'));
        $form->mobile('phone', __('Телефон'));
        $form->datetime('start_time', __('Дата и время'))->default(date('Y-m-d H:i:s'));
        $form->date('date', __('Дата'))->default(date('Y-m-d'));
        $form->datetime('end_time', __('Дата и время окончания записи'))->default(date('Y-m-d H:i:s'));
        $form->select('name_service','Услуга')->options(Service::all()->pluck('name_service','id'));
        return $form;
    }
}

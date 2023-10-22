<?php

namespace App\Admin\Controllers;

use App\ModeOfSchedule;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ModeOfScheduleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ModeOfSchedule';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ModeOfSchedule());

//        $grid->column('id', __('Id'));
        $grid->column('two_in_two',__('График 2 через 2'))->switch(['1' => true, '0' => false]);
        $grid->column('latest_work_day',__('Крайний рабочий день с него начинается счет 2 через 2'))->date();
//        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(ModeOfSchedule::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('two_in_two', __('График 2 через 2'));
        $show->field('latest_work_day', __('Крайний рабочий день с него начинается счет'));
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
        $form = new Form(new ModeOfSchedule());

        $form->switch('two_in_two', __('2 через'));
        $form->date('latest_work_day', __('Крайний рабочий день с него начинается счет'));

        return $form;
    }
}

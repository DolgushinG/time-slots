<?php

namespace App\Admin\Controllers;

use App\TimeSlot;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TimeSlotController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TimeSlot';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TimeSlot());

//        $grid->column('id', __('Id'));
        $grid->column('time_slot', __('Время для записи'));
        $grid->column('is_open', __('Открыть время на все дни'))->switch(['1' => true, '0' => false]);
        $grid->column('monday', __('Понедельник'))->switch(['1' => true, '0' => false]);
        $grid->column('tuesday', __('Вторник'))->switch(['1' => true, '0' => false]);
        $grid->column('time_slot', __('Время для записи'));
        $grid->column('wednesday', __('Среда'))->switch(['1' => true, '0' => false]);
        $grid->column('thursday', __('Четверг'))->switch(['1' => true, '0' => false]);
        $grid->column('time_slot', __('Время для записи'));
        $grid->column('friday', __('Пятница'))->switch(['1' => true, '0' => false]);
        $grid->column('saturday', __('Суббота'))->switch(['1' => true, '0' => false]);
        $grid->column('time_slot', __('Время для записи'));
        $grid->column('sunday', __('Воскресенье'))->switch(['1' => true, '0' => false]);
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
        $show = new Show(TimeSlot::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('time_slot', __('Time slot'));
        $show->field('is_open', __('Открыть время на все дни'));
        $show->field('monday', __('Понедельник'));
        $show->field('tuesday', __('Вторник'));
        $show->field('wednesday', __('Среда'));
        $show->field('thursday', __('Четверг'));
        $show->field('friday', __('Пятница'));
        $show->field('saturday', __('Суббота'));
        $show->field('sunday', __('Воскресенье'));
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
        $form = new Form(new TimeSlot());

        $form->text('time_slot', __('Time slot'));
        $form->switch('is_open', __('Открыть время на все дни'));
        $form->switch('monday', __('Понедельник'));
        $form->switch('tuesday', __('Вторник'));
        $form->switch('wednesday', __('Среда'));
        $form->switch('thursday', __('Четверг'));
        $form->switch('friday', __('Пятница'));
        $form->switch('saturday', __('Суббота'));
        $form->switch('sunday', __('Воскресенье'));
        return $form;
    }
}

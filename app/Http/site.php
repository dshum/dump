<?php

use Moonlight\Main\Site;
use Moonlight\Main\Item;
use Moonlight\Main\Element;
use Moonlight\Main\Rubric;
use Moonlight\Properties\BaseProperty;
use Moonlight\Properties\MainProperty;
use Moonlight\Properties\OrderProperty;
use Moonlight\Properties\CheckboxProperty;
use Moonlight\Properties\DatetimeProperty;
use Moonlight\Properties\DateProperty;
use Moonlight\Properties\FloatProperty;
use Moonlight\Properties\ImageProperty;
use Moonlight\Properties\IntegerProperty;
use Moonlight\Properties\OneToOneProperty;
use Moonlight\Properties\ManyToManyProperty;
use Moonlight\Properties\PasswordProperty;
use Moonlight\Properties\RichtextProperty;
use Moonlight\Properties\TextareaProperty;
use Moonlight\Properties\TextfieldProperty;
use Moonlight\Properties\PluginProperty;
use Moonlight\Properties\VirtualProperty;

$site = \App::make('site');

$site->

	/*
	 * Пользователь
	 */

	addItem(
		Item::create('App\User')->
		setTitle('Пользователь')->
        setCreate(true)->
        setPerPage(10)->
        addOrderBy('created_at', 'desc')->
		addProperty(
			MainProperty::create('email')->
			setTitle('E-mail')->
			addRule('email', 'Некорректный адрес электронной почты')->
			setRequired(true)
		)->
		addProperty(
			PasswordProperty::create('password')->
			setTitle('Пароль')
		)->
        addProperty(
			TextfieldProperty::create('first_name')->
			setTitle('Имя')->
			setRequired(true)->
			setShow(true)->
			setEditable(true)
		)->
        addProperty(
			TextfieldProperty::create('last_name')->
			setTitle('Фамилия')->
			setRequired(true)->
			setShow(true)->
			setEditable(true)
		)->
		addProperty(
			ImageProperty::create('photo')->
			setTitle('Фотография')->
			setResize(200, 200, 100)->
			setShow(true)
		)->
        addProperty(
			CheckboxProperty::create('activated')->
			setTitle('Активирован')->
			setShow(true)->
			setEditable(true)
		)->
        addProperty(
			CheckboxProperty::create('banned')->
			setTitle('Заблокирован')->
			setShow(true)->
			setEditable(true)
		)->
        addProperty(
			OneToOneProperty::create('service_section_id')->
			setTitle('Служебный раздел')->
			setRelatedClass('App\ServiceSection')->
			setRequired(true)->
			setParent(true)->
            setOpenItem(true)
		)->
		addTimestamps()->
		addSoftDeletes()
	)->
    
    /*
	 * Раздел сайта
	 */

	addItem(
		Item::create('App\Section')->
		setTitle('Раздел сайта')->
		setRoot(true)->
        setCreate(true)->
		setElementPermissions(true)->
		addOrder()->
		addProperty(
			MainProperty::create('name')->
			setTitle('Название')->
			setRequired(true)
		)->
		addProperty(
			TextfieldProperty::create('url')->
			setTitle('Адрес страницы')->
            setRequired(true)->
			addRule('regex:/^[a-z0-9\-]+$/i', 'Допускаются латинские буквы, цифры и дефис.')
		)->
		addProperty(
			TextfieldProperty::create('title')->
			setTitle('Title')->
			setShow(true)->
			setEditable(true)
		)->
		addProperty(
			TextfieldProperty::create('h1')->
			setTitle('H1')->
			setShow(true)->
			setEditable(true)
		)->
		addProperty(
			TextfieldProperty::create('meta_keywords')->
			setTitle('META Keywords')->
			setShow(true)->
			setEditable(true)
		)->
		addProperty(
			TextareaProperty::create('meta_description')->
			setTitle('META Description')->
			setShow(true)->
			setEditable(true)
		)->
		addProperty(
			RichtextProperty::create('fullcontent')->
			setTitle('Текст раздела')
		)->
        addProperty(
			OneToOneProperty::create('section_id')->
			setTitle('Раздел сайта')->
			setRelatedClass('App\Section')->
			setParent(true)
		)->
		addTimestamps()->
		addSoftDeletes()
	)->

	/*
	 * Служебный раздел
	 */

	addItem(
		Item::create('App\ServiceSection')->
		setTitle('Служебный раздел')->
		setRoot(true)->
        setCreate(true)->
		setElementPermissions(true)->
		addOrder()->
		addProperty(
			MainProperty::create('name')->
			setTitle('Название')->
			setRequired(true)
		)->
		addProperty(
			OneToOneProperty::create('service_section_id')->
			setTitle('Служебный раздел')->
			setRelatedClass('App\ServiceSection')->
			setParent(true)->
            setOpenItem(true)->
			setShow(true)
		)->
		addTimestamps()->
		addSoftDeletes()
	)->

	/*
	 * Продукт питания
	 */

	addItem(
		Item::create('App\Foodstuff')->
		setTitle('Продукт питания')->
		setCreate(true)->
		addOrderBy('name', 'asc')->
		addProperty(
			MainProperty::create('name')->
			setTitle('Название')->
			setRequired(true)
		)->
		addProperty(
			IntegerProperty::create('calories')->
			setTitle('Калории')->
			setRequired(true)->
			setShow(true)
		)->
		addProperty(
			OneToOneProperty::create('service_section_id')->
			setTitle('Служебный раздел')->
			setRelatedClass('App\ServiceSection')->
			setParent(true)->
            setOpenItem(true)->
			setRequired(true)
		)->
		addTimestamps()->
		addSoftDeletes()
	)->

	/*
	 * Съеденный продукт питания
	 */

	addItem(
		Item::create('App\EatenFoodstuff')->
		setTitle('Съеденный продукт питания')->
		setCreate(true)->
		addOrderBy('created_at', 'desc')->
		addProperty(
			MainProperty::create('name')->
			setTitle('Название')
		)->
		addProperty(
			OneToOneProperty::create('foodstuff_id')->
			setTitle('Продукт питания')->
			setRelatedClass('App\Foodstuff')->
			setOpenItem(true)->
			setRequired(true)->
			setShow(true)
		)->
		addProperty(
			IntegerProperty::create('grams')->
			setTitle('Вес, гр')->
			setRequired(true)->
			setShow(true)
		)->
		addProperty(
			VirtualProperty::create('calories')->
			setTitle('Калории')->
			setShow(true)
		)->
		addProperty(
			OneToOneProperty::create('service_section_id')->
			setTitle('Служебный раздел')->
			setRelatedClass('App\ServiceSection')->
			setParent(true)->
            setOpenItem(true)->
			setRequired(true)
		)->
		addTimestamps(false)->
		addSoftDeletes()
	)->

	/*
	 * Вес
	 */

	addItem(
		Item::create('App\Weight')->
		setTitle('Вес')->
		setCreate(true)->
		addOrderBy('created_at', 'desc')->
		addProperty(
			MainProperty::create('name')->
			setTitle('Название')
		)->
		addProperty(
			FloatProperty::create('weight')->
			setTitle('Вес, кг')->
			setRequired(true)->
			setShow(true)
		)->
		addProperty(
			OneToOneProperty::create('service_section_id')->
			setTitle('Служебный раздел')->
			setRelatedClass('App\ServiceSection')->
			setParent(true)->
            setOpenItem(true)->
			setRequired(true)
		)->
		addTimestamps(false)->
		addSoftDeletes()
	)->

	/*
	 * Заработок Ольки
	 */

	addItem(
		Item::create('App\Earning')->
		setTitle('Заработок Ольки')->
		setCreate(true)->
		addOrderBy('created_at', 'desc')->
		addProperty(
			MainProperty::create('name')->
			setTitle('Название')->
			setRequired(true)
		)->
		addProperty(
			FloatProperty::create('price')->
			setTitle('Сумма, руб.')->
			setShow(true)
		)->
		addProperty(
			OneToOneProperty::create('service_section_id')->
			setTitle('Служебный раздел')->
			setRelatedClass('App\ServiceSection')->
			setParent(true)->
            setOpenItem(true)->
			setRequired(true)
		)->
		addTimestamps(false)->
		addSoftDeletes()
	)->

	/*
	 * Расход Ольки
	 */

	addItem(
		Item::create('App\Expense')->
		setTitle('Расход Ольки')->
		setCreate(true)->
		addOrderBy('created_at', 'desc')->
		addProperty(
			MainProperty::create('name')->
			setTitle('Название')->
			setRequired(true)
		)->
		addProperty(
			FloatProperty::create('price')->
			setTitle('Сумма, руб.')->
			setShow(true)
		)->
		addProperty(
			OneToOneProperty::create('service_section_id')->
			setTitle('Служебный раздел')->
			setRelatedClass('App\ServiceSection')->
			setParent(true)->
            setOpenItem(true)->
			setRequired(true)
		)->
		addTimestamps(false)->
		addSoftDeletes()
	)->

	/*
	 * Задача
	 */

	addItem(
		Item::create('App\Task')->
		setTitle('Задача')->
		setCreate(true)->
		addOrderBy('created_at', 'desc')->
		addProperty(
			MainProperty::create('name')->
			setTitle('Название')->
			setRequired(true)
		)->
		addProperty(
			TextfieldProperty::create('person')->
			setTitle('Исполнитель')->
			setShow(true)
		)->
		addProperty(
			CheckboxProperty::create('complete')->
			setTitle('Исполнено')->
			setShow(true)
		)->
		addProperty(
			OneToOneProperty::create('service_section_id')->
			setTitle('Служебный раздел')->
			setRelatedClass('App\ServiceSection')->
			setParent(true)->
            setOpenItem(true)->
			setRequired(true)
		)->
		addTimestamps(false)->
		addSoftDeletes()
	)->

	bind(Site::ROOT, ['App.ServiceSection'])->
	bind(sprintf('App.ServiceSection.%d', env('SITE_DICTS', 1)), ['App.ServiceSection'])->
	bind(sprintf('App.ServiceSection.%d', env('SITE_FOODSTUFFS', 2)), ['App.Foodstuff'])->
	bind(sprintf('App.ServiceSection.%d', env('SITE_STATISTICS', 3)), ['App.ServiceSection'])->
	bind(sprintf('App.ServiceSection.%d', env('SITE_EATEN_FOODSTUFFS', 4)), ['App.EatenFoodstuff'])->
	bind(sprintf('App.ServiceSection.%d', env('SITE_WEIGTH_LOG', 7)), ['App.Weight'])->
	bind(sprintf('App.ServiceSection.%d', env('SITE_EARNINGS', 8)), [
		'App.Earning', 'App.Expense'
	])->
	bind(sprintf('App.ServiceSection.%d', env('SITE_TASKS', 9)), ['App.Task'])->

	addRubric(
		Rubric::create('service_sections', 'Служебные разделы')->
		bind([
			Site::ROOT => 'App.ServiceSection'
		])
	)->
	addRubric(
		Rubric::create('stat', 'Статистика')->
		bind([
			sprintf('App.ServiceSection.%d', env('SITE_STATISTICS', 3)) => 'App.ServiceSection'
		])
	)->
	addRubric(
		Rubric::create('dicts', 'Справочники')->
		bind([
			sprintf('App.ServiceSection.%d', env('SITE_DICTS', 1)) => 'App.ServiceSection'
		])
	)->

	addBrowsePlugin(sprintf('App.ServiceSection.%d', env('SITE_EATEN_FOODSTUFFS', 4)), '\App\Http\Plugins\EatenToday')->
	addEditScript('App.EatenFoodstuff', '/js/plugins/food.js')->

	end();
<?php namespace Verbant\Livewire\Widgets;

use Str;
use Input;
use Cms\Classes\Theme;
use Backend\Classes\WidgetBase;

/**
 * component list widget.
 *
 * @package verbant.livewire
 * @author Wim verhoogt
 */
class ComponentList extends WidgetBase
{
    use \Backend\Traits\SearchableWidget;
    use \Backend\Traits\CollapsableWidget;

    protected $theme;

    public $noRecordsMessage = 'winter.builder::lang.model.no_records';

    public function __construct($controller, $alias)
    {
        $this->alias = $alias;
        $this->theme = Theme::getEditTheme();
        parent::__construct($controller, []);
        $this->bindToController();
    }

    /**
     * Renders the widget.
     * @return string
     */
    public function render()
    {
        return $this->makePartial('body', $this->getRenderData());
    }

    public function updateList()
    {
        return ['#'.$this->getId('plugin-model-list') => $this->makePartial('items', $this->getRenderData())];
    }

    /*
     * Event handlers
     */

    public function onUpdate()
    {
        return $this->updateList();
    }

    public function onSearch()
    {
        $this->setSearchTerm(Input::get('search'));
        return $this->updateList();
    }

    /*
     * Methods for the internal use
     */

    protected function getData()
    {
        $searchTerm = Str::lower($this->getSearchTerm());
        $components = [];

        // Apply the search
        //
        if (strlen($searchTerm)) {
            $words = explode(' ', $searchTerm);
            $result = [];

            // foreach ($models as $modelInfo) {
            //     if ($this->textMatchesSearch($words, $modelInfo['model']->className)) {
            //         $result[] = $modelInfo;
            //     }
            // }

        }

        return $components;
    }

    protected function getComponentList()
    {
        // $components = 
        // $result = [];

        // foreach ($models as $model) {
        //     $result[] = [
        //         'model' => $model,
        //         'forms' => ModelFormModel::listModelFiles($pluginCode, $model->className),
        //         'lists' => ModelListModel::listModelFiles($pluginCode, $model->className)
        //     ];
        // }

        // return $result;
    }

    protected function getRenderData()
    {
        return [
            'items' => $this->getData()
        ];
    }
}
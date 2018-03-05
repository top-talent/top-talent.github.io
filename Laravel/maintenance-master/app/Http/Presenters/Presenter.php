<?php

namespace App\Http\Presenters;

use App\Models\Revision;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Fluent;
use Orchestra\Contracts\Html\Form\Factory as FormFactory;
use Orchestra\Contracts\Html\Form\Grid as FormGrid;
use Orchestra\Contracts\Html\Form\Presenter as PresenterContract;
use Orchestra\Contracts\Html\Table\Column;
use Orchestra\Contracts\Html\Table\Factory as TableFactory;
use Orchestra\Contracts\Html\Table\Grid as TableGrid;
use Orchestra\Support\Facades\HTML;

abstract class Presenter implements PresenterContract
{
    /**
     * Implementation of form contract.
     *
     * @var \Orchestra\Contracts\Html\Form\Factory
     */
    protected $form;

    /**
     * Implementation of table contract.
     *
     * @var \Orchestra\Contracts\Html\Table\Factory
     */
    protected $table;

    /**
     * The default amount of records to display per page.
     *
     * @var int
     */
    protected $perPage = 10;

    /**
     * Constructor.
     *
     * @param FormFactory  $form
     * @param TableFactory $table
     */
    public function __construct(FormFactory $form, TableFactory $table)
    {
        $this->form = $form;
        $this->table = $table;
    }

    /**
     * Returns a new Fluent instance.
     *
     * @param array $attributes
     *
     * @return Fluent
     */
    public function fluent(array $attributes = [])
    {
        return new Fluent($attributes);
    }

    /**
     * Handles the form action URL.
     *
     * @param string $url
     *
     * @return string
     */
    public function handles($url)
    {
        return $url;
    }

    /**
     * {@inheritdoc}
     */
    public function setupForm(FormGrid $form)
    {
        $form->layout('components.form');
    }

    /**
     * Returns a new table of all revisions.
     *
     * @param string    $for
     * @param MorphMany $revisions
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function tableHistory($for, MorphMany $revisions)
    {
        return $this->table->of("$for.revisions", function (TableGrid $table) use ($revisions) {
            $table->with($revisions)->paginate($this->perPage);

            $table->pageName = 'history';

            $table->column('user_responsible', function (Column $column) {
                $column->value = function (Revision $revision) {
                    $user = $revision->getUserResponsible();

                    if ($user instanceof User) {
                        return $user->getRecipientName();
                    }

                    return HTML::create('em', 'None');
                };
            });

            $table->column('changed', function (Column $column) {
                $column->value = function (Revision $revision) {
                    return $revision->getColumnName();
                };
            });

            $table->column('from', function (Column $column) {
                $column->value = function (Revision $revision) {
                    $old = $revision->getOldValue();

                    if (is_null($old)) {
                        return HTML::create('em', 'None');
                    }

                    return $old;
                };
            });

            $table->column('to', function (Column $column) {
                $column->value = function (Revision $revision) {
                    $new = $revision->getNewValue();

                    if (is_null($new)) {
                        return HTML::create('em', 'None');
                    }

                    return $new;
                };
            });

            $table->column('On', 'created_at');
        });
    }
}

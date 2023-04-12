<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\MuchatUser;

use App\Orchid\Screens\Fields\SlugInputField;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class MuchatUserEditLayout extends Rows {
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array {
        return [
            Input::make('muchat_user.name')
                 ->type('text')
                 ->max(255)
                 ->title(__('Name'))
                 ->placeholder(__('Name')),

            SlugInputField::make('muchat_user.slug')
                          ->type('text')
                          ->required()
                          ->title(__('Slug'))
                          ->placeholder(__('Slug')),

            Input::make('muchat_user.max_usage')
                 ->type('number')
                 ->value(0)
                 ->title(__('Max usage'))
                 ->placeholder(__('max_usage')),

            Input::make('muchat_user.max_days')
                 ->type('number')
                 ->value(0)
                 ->title(__('Max days'))
                 ->placeholder(__('max_days')),

            Input::make('muchat_user.expires_at')
                 ->type('datetime-local')
                 ->title(__('Expires at'))
                 ->placeholder(__('expires_at')),
        ];
    }
}

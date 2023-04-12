<?php

namespace App\Orchid\Screens\Muchat;

use App\Models\MuchatUser;
use App\View\Components\InlineEditor;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class MuchatUserListScreen extends Screen {
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable {
        $query = MuchatUser::filters()->defaultSort('id', 'desc');
        logger('query', ['sql' => $query->toSql()]);
        return [
            'muchat_users' => $query->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string {
        return '用户管理';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.muchat.muchat_users.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable {
        return [
            Layout::table('muchat_users', [
                TD::make('id')->sort(),
                TD::make('slug'),
                TD::make('expires_at')->sort()->component(InlineEditor::class, ['name' => 'expires_at', 'maxWidth' => 190, 'type' => 'datetime-local', 'updateUrl' => '/api/muchat/muchat_user/update']),
                TD::make('bad_cnt')->sort(),
                TD::make('name')->component(InlineEditor::class, ['name' => 'name', 'maxWidth' => 60]),
                TD::make('usage')->sort(),
                TD::make('max_usage')->sort()->component(InlineEditor::class, ['name' => 'max_usage', 'maxWidth' => 60]),
                TD::make('first_time')->sort(),
                TD::make('max_days')->sort(),
                TD::make('first_ip'),
                TD::make('referer'),

                // TD::make('created_at', 'Date of creation')
                //   ->render(function ($model) {
                //       return $model->created_at ? $model->created_at->toDateTimeString() : null;
                //   })->sort(),

                TD::make('updated_at', 'Update date')
                    ->render(function ($model) {
                        return $model->updated_at ? $model->updated_at->toDateTimeString() : null;
                    })->sort(),

                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn(MuchatUser $user) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.muchat.muchat_users.edit', $user->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $user->id,
                                ]),
                        ])),
            ]),];
    }
}

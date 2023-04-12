<?php

namespace App\Orchid\Screens\Muchat;

use App\Models\MuchatUser;
use App\Orchid\Layouts\MuchatUser\MuchatUserEditLayout;
use App\View\Components\InlineEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class MuchatUserEditScreen extends Screen {
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
            Button::make(__('Save'))
                  ->icon('save')
                  ->method('save'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable {
        return [
            Layout::columns([
                MuchatUserEditLayout::class,
            ]),
        ];
    }

    /**
     * @param MuchatUser $user
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(MuchatUser $user, Request $request) {
        $request->validate([
            'muchat_user.slug' => [
                'required',
                Rule::unique(MuchatUser::class, 'slug')->ignore($user),
            ],
        ]);

        $user
            ->fill($request->collect('muchat_user')->toArray())
            ->save();

        Toast::info(__('Muchat User was saved.'));

        return redirect()->route('platform.muchat.muchat_users');
    }

}

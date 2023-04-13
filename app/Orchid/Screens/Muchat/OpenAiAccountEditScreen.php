<?php

namespace App\Orchid\Screens\Muchat;

use App\Models\OpenAiAccount;
use App\Orchid\Layouts\OpenAiAccount\OpenAiAccountEditLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class OpenAiAccountEditScreen extends Screen {
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(OpenAiAccount $open_ai_account): iterable {
        return [
            'open_ai_account' => $open_ai_account,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string {
        return 'OpenAi账号管理';
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
                OpenAiAccountEditLayout::class,
            ]),
        ];
    }

    /**
     * @param OpenAiAccount $user
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(OpenAiAccount $user, Request $request) {
        $request->validate([
            'open_ai_account.email' => [
                'required',
                Rule::unique(OpenAiAccount::class, 'email')->ignore($user),
            ],
            'open_ai_account.api_key' => [
                'required',
                Rule::unique(OpenAiAccount::class, 'api_key')->ignore($user),
            ],
        ]);

        $user
            ->fill($request->collect('open_ai_account')->toArray())
            ->save();

        Toast::info(__('OpenAi Account was saved.'));

        return redirect()->route('platform.muchat.open_ai_accounts');
    }

}

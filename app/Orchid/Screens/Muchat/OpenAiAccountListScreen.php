<?php

namespace App\Orchid\Screens\Muchat;

use App\Models\OpenAiAccount;
use App\View\AsComponents\Datetime;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class OpenAiAccountListScreen extends Screen {
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable {
        $query = OpenAiAccount::filters()->defaultSort('id', 'desc');
        return [
            'open_ai_accounts' => $query->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string {
        return 'OpenAi 账号管理';
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
                ->route('platform.muchat.open_ai_accounts.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable {
        return [
            Layout::table('open_ai_accounts', [
                TD::make('id')->sort(),

                TD::make('email')->sort(),
                TD::make('first_time', '激活时间')->sort()->asComponent(Datetime::class),
                TD::make('usd_spent', '消耗')->sort(),
                TD::make('usd_spent_limit', '最大消耗')->sort()->defaultHidden(),
                TD::make('api_key', 'API KEY')->sort()->render(fn(OpenAiAccount $openAiAccount) => substr($openAiAccount->api_key, 0, 5) . '***'),
                TD::make('status', '状态')->sort(),
                TD::make('query_cnt', '查询次数')->sort(),
                TD::make('credit_used')->sort()->defaultHidden(),
                TD::make('credit_available')->sort()->defaultHidden(),
                TD::make('expires_at')->sort()->defaultHidden(),
                TD::make('name', '名称')->sort(),
                TD::make('password')->sort()->defaultHidden(),
                TD::make('created_at')->sort()->defaultHidden(),
                TD::make('updated_at', '更新时间')->sort()->asComponent(Datetime::class),
                TD::make('deleted_at')->sort()->defaultHidden(),
                TD::make('email_password')->sort()->defaultHidden(),

                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn(OpenAiAccount $openAiAccount) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.muchat.open_ai_accounts.edit', $openAiAccount->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $openAiAccount->id,
                                ]),
                        ])),
            ]),];
    }
}

<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\OpenAiAccount;

use App\Models\OpenAiAccount;
use App\Orchid\Screens\Fields\SlugInputField;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class OpenAiAccountEditLayout extends Rows {
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array {
        return [
            Input::make('open_ai_account.name')->type('text')->max(255)->title(__('名称'))->placeholder(__('Name')),

            Input::make('open_ai_account.email')
                 ->type('text')
                 ->required()
                 ->title(__('Email'))
                 ->placeholder(__('Email')),

            Input::make('open_ai_account.api_key')
                 ->type('text')
                 ->required()
                 ->title(__('Api key'))
                 ->placeholder(__('api_key')),

            Input::make('open_ai_account.password')->type('text')->title(__('密码'))->placeholder(__('password')),
            Input::make('open_ai_account.email_password')->type('text')->title(__('邮箱密码'))->placeholder(__('email_password')),

            Input::make('open_ai_account.usd_spent')->type('number')->title(__('消耗'))->placeholder(__('usd_spent'))->value(0),
            Input::make('open_ai_account.usd_spent_limit')->type('number')->title(__('最大消耗'))->placeholder(__('usd_spent_limit'))->value(0),
            Select::make('open_ai_account.status')->options(array_merge(['' => '请选择'], OpenAiAccount::getStatuses()))->value(OpenAiAccount::OAS_ACTIVE)->title(__('状态'))->placeholder(__('status')),
            Input::make('open_ai_account.query_cnt')->type('number')->title(__('查询次数'))->placeholder(__('query_cnt'))->value(0),
            // Input::make('credit_used')->type('number')->title(__('credit_used'))->placeholder(__('credit_used')),
            // Input::make('credit_available')->type('number')->title(__('credit_available'))->placeholder(__('credit_available')),

            // Input::make('open_ai_account.expires_at')
            //     ->type('datetime-local')
            //     ->title(__('Expires at'))
            //     ->placeholder(__('expires_at')),
        ];
    }
}

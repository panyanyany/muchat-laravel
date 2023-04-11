<?php

namespace App\Orchid\Screens\Muchat;

use App\Models\MuchatUser;
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
        return [];
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
                TD::make('expires_at')->sort(),
                TD::make('bad_cnt')->sort(),
                TD::make('name'),
                TD::make('usage')->sort(),
                TD::make('max_usage')->sort(),
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
            ]),];
    }
}

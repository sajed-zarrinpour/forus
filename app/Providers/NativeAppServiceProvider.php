<?php

namespace App\Providers;

use Native\Laravel\Facades\Window;
use Native\Laravel\Facades\MenuBar;
use Native\Laravel\Contracts\ProvidesPhpIni;
use Native\Laravel\Menu\Menu;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        MenuBar::create()
            ->width(400)
            ->height(600)
            // ->showDockIcon()
            ->label('ForUs')
            ->icon(storage_path('app/menuBarIcon.png'))
            ->withContextMenu(
                Menu::new()
                    ->label('My Application')
                    ->separator()
                    ->link('https://nativephp.com', 'Learn more…')
                    ->separator()
                    ->quit()
            );
        
        Menu::new()
        ->appMenu()
            ->submenu('NativePHP', Menu::new()
                ->link('https://nativephp.com', 'Documentation')
            )
            ->register();

        Window::open()
            ->width(800)
            ->height(800)
            ->title('ForUs')
            ->route('home')
            ->rememberState()
            ->hideMenu();
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [
        ];
    }
}
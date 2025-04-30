<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use App\Services\BreezeCoreService;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Stephenjude\FilamentDebugger\DebuggerPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Vormkracht10\FilamentMails\FilamentMailsPlugin;
use FilipFonal\FilamentLogManager\FilamentLogManager;
use GeoSot\FilamentEnvEditor\FilamentEnvEditorPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentMailsPlugin::make(),
                BreezeCoreService::make(),
                DebuggerPlugin::make()
                    ->telescopeNavigation(true)
                    ->horizonNavigation(false)
                    ->pulseNavigation(false),
                FilamentLogManager::make(),
                FilamentEnvEditorPlugin::make()
                    ->navigationGroup('Settings')
                    ->navigationLabel('Env Editor')
                    ->navigationIcon('heroicon-o-document-text')
                    ->navigationSort(1)
                    ->hideKeys(
                        'APP_KEY',
                        'APP_URL',
                        'DB_PASSWORD',
                        'DB_DATABASE',
                        'DB_HOST',
                        'DB_USERNAME',
                        'DB_CONNECTION',
                        'DB_HOST',
                        'DB_PORT',
                        'MAIL_PASSWORD',
                        'MAIL_USERNAME',
                        'MAIL_HOST',
                        'MAIL_PORT',
                        'MAIL_ENCRYPTION',
                        'MAIL_FROM_ADDRESS',
                        'MAIL_FROM_NAME',
                        'MAIL_MAILER',
                        'MAIL_ENCRYPTION',

                    ),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}

<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\LoginCustom;
use FinityLabs\FinAvatar\AvatarProviders\UiAvatarsProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\View\PanelsRenderHook;
use Filament\Support\Colors\Color;
use Andreia\FilamentUiSwitcher\FilamentUiSwitcherPlugin;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Illuminate\Session\Middleware\StartSession;
use Filament\Navigation\MenuItem;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Filament\Support\Enums\Width;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->favicon(asset('images/favicon.png'))
            ->path('admin')
            ->spa()
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->login(LoginCustom::class)
            ->colors([
                'primary' => Color::Sky,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                //FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugin(
                FilamentUiSwitcherPlugin::make()
                    ->iconRenderHook(PanelsRenderHook::USER_MENU_BEFORE)
            )
            ->defaultAvatarProvider(UiAvatarsProvider::class)
            ->databaseNotifications()
            ->maxContentWidth(Width::Full)
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('18rem')
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label('Edit Profile')
                    ->url(fn (): string => EditProfilePage::getUrl())
                    ->icon('heroicon-o-user'),
            ])
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->slug('edit-profile')
                    ->setTitle('Edit Profile')
                    ->setNavigationLabel('Edit Profile')
                    ->setIcon('heroicon-o-user')
                    ->shouldRegisterNavigation(false)
                    ->shouldShowDeleteAccountForm(false)
                ->shouldShowSanctumTokens()
            ])
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugin(
                FilamentShieldPlugin::make()
                    ->navigationSort(5)
            );
    }
}

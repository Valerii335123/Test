<?php

namespace App\Providers;

use App\Repositories\Balance\BalanceInterface;
use App\Repositories\Balance\BalanceRepository;
use App\Repositories\Callback\CallbackEloquentRepository;
use App\Repositories\Callback\CallbackRepositoryInterface;
use App\Repositories\CommentRepository;
use App\Repositories\Country\CountryEloquentRepository;
use App\Repositories\Country\CountryRepositoryInterface;
use App\Repositories\CryptoCurrencyExchanger\CryptoCurrencyExchangerInterface;
use App\Repositories\CryptoCurrencyExchanger\CryptoCurrencyExchangerRepository;
use App\Repositories\CryptoRates\CryptoRatesRepository;
use App\Repositories\CryptoRates\CryptoRatesRepositoryInterface;
use App\Repositories\Deposit\DepositTransactionInterface;
use App\Repositories\Deposit\DepositTransactionRepository;
use App\Repositories\EmailTemplate\EmailTemplateRepository;
use App\Repositories\EmailTemplate\EmailTemplateRepositoryInterface;
use App\Repositories\ExchangeRates\ExchangeRatesRepositoryInterface;
use App\Repositories\ExchangeRates\OpenExchangeRatesRepository;
use App\Repositories\Interfaces\ICommentRepository;
use App\Repositories\Interfaces\IPostRepository;
use App\Repositories\Language\LanguageEloquentRepository;
use App\Repositories\Language\LanguageRepositoryInterface;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Repositories\Partner\PartnerRepository;
use App\Repositories\Partner\PartnerRepositoryInterface;
use App\Repositories\PasswordReset\PasswordResetEloquentRepository;
use App\Repositories\PasswordReset\PasswordResetRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\Profile\ProfileEloquentRepository;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\Storage\LocalStorage;
use App\Repositories\Storage\StorageInterface;
use App\Repositories\TradingAccount\TradingAccountInterface;
use App\Repositories\TradingAccount\TradingAccountRepository;
use App\Repositories\TradingAccount\TradingActivityInterface;
use App\Repositories\TradingAccount\TradingActivityRepository;
use App\Repositories\TradingAccount\WebApiTokenRepository;
use App\Repositories\TradingPlatform\ManagerApiAccountInterface;
use App\Repositories\TradingPlatform\TickTrader\ManagerApiAccount;
use App\Repositories\TradingPlatform\TickTrader\WebApiToken\WebApiToken;
use App\Repositories\TradingPlatform\TickTrader\WebApiToken\WebApiTokenInterface;
use App\Repositories\TradingPlatform\TradingHistoryInterface;
use App\Repositories\TradingPlatform\TradingHistoryRepository;
use App\Repositories\TradingPlatform\WebApiTokenTickTrader;
use App\Repositories\User\UserEloquentRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Visit\VisitInterface;
use App\Repositories\Visit\VisitRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public $bindings = [
        IPostRepository::class => PostRepository::class,
        ICommentRepository::class => CommentRepository::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

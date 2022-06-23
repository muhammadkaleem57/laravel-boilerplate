<?php


function nullToString($value): ?string
{
    return $value ?? '';
}

function formatDate($date, $format = DATE_FORMAT): string
{
    return nullToString($date) !== '' ? \Carbon\Carbon::parse($date)->format($format) : '';
}

function formatDateTime($dateTime): string
{
    return nullToString($dateTime) !== '' ? \Carbon\Carbon::parse($dateTime)->format(DATE_TIME_FORMAT) : '';
}

function convertTimestampToDate($timestamp): string
{
    return $timestamp ? date(DATE_TIME_FORMAT, $timestamp) : '';
}

function chars(): array
{
    return range('A', 'Z');
}

function isSsl($url): bool
{
    return str_contains($url, 'https://');
}

function isAdmin(): bool
{
    return auth()->user()->isAdmin();
}

function isVendor(): bool
{
    return auth()->user()->isVendor();
}

function isUser(): bool
{
    return auth()->user()->isUser();
}


function encodeID($id, $length = 8): string
{
    if ($length === 20)
        \Vinkla\Hashids\Facades\Hashids::setDefaultConnection('length-20');
    else
        config(['hashids.connections.main.length' => $length]);

    return $id !== null && $id !== '' && $id !== NO ? \Vinkla\Hashids\Facades\Hashids::encode($id) : '';
}

function decodeID($id, $length = 8): string
{
    config(['hashids.connections.main.length' => $length]);

    try {
        $decodedID = \Vinkla\Hashids\Facades\Hashids::decode($id);

        return $decodedID[0];

    } catch (\Exception $exception) {
        return '';
    }
}


function nullToEmptyString($value): string
{
    return $value === null ? '' : $value;
}

function formatAmount($amount, $currency = 'USD'): string
{
    $amount = nullToEmptyString($amount);
    if ($amount === '')
        return $amount;

    $currency = $currency ?? 'USD';
    $amount = (float)$amount;

    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

    $formattedAmount =  $formatter->formatCurrency($amount, strtoupper($currency));

    if (strtoupper($currency) !== 'AUD')
        return $formattedAmount;

    return str_replace('A$', 'AUD ', $formattedAmount);
}

function getRouteAlias(): ?string
{
    $alias = 'admin';

    if (auth()->check()) {
        $user = auth()->user();

        if ($user->isVendor())
            $alias = 'vendor';

        else if ($user->isUser())
            $alias = 'user';
    }

    return $alias;
}


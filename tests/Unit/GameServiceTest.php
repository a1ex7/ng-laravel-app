<?php

use App\Services\GameService;

beforeEach(function () {
    $this->gameService = app(GameService::class);
});

test('check chance correct', function () {
    expect($this->gameService->chance())
        ->toBeInt()
        ->toBeGreaterThanOrEqual(1)
        ->toBeLessThanOrEqual(1000);
});

test('check generate invite', function () {
    expect($this->gameService->generateInvite())
        ->toBeUuid();
});

test('check win correct', function () {
    expect($this->gameService->isWin(1))
        ->toBeFalse()
        ->and($this->gameService->isWin(2))
        ->toBeTrue();
});

test('check amount correct', function () {
    expect($this->gameService->amount(10))->toEqual(1)
        ->and($this->gameService->amount(300))->toEqual(30)
        ->and($this->gameService->amount(300))->toEqual(30)
        ->and($this->gameService->amount(600))->toEqual(180)
        ->and($this->gameService->amount(900))->toEqual(450)
        ->and($this->gameService->amount(1000))->toEqual(700);
});

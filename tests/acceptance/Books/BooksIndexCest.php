<?php namespace App\Tests\Acceptance;

use AcceptanceTester;

class BooksIndexCest
{
    private const URL = '/books/';
    private const BOOK_ID = 88;

    /**
     * @param AcceptanceTester $I
     */
    public function _before(AcceptanceTester $I): void
    {
        $I->haveInDatabase('book', [
            'id' => self::BOOK_ID,
            'name' => 'Testing book',
            'price' => 99.99,
            'number_of_pages' => 120,
            'year' => 2018,
            'created' => '2020-04-08 19:01:05'
        ]);
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryToDisplayAllBooks(AcceptanceTester $I): void
    {
        $I->amOnPage(self::URL);

        $I->see('All book');
        $I->seeElement('.book-row');
        $I->see('Testing book');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryToDisplayEditView(AcceptanceTester $I): void
    {
        $I->amOnPage(self::URL);

        $I->click('//a[@href="/books/'.self::BOOK_ID.'/edit"]');
        $I->see('Edit book:');
        $I->seeInField(['name' => 'book[name]'],'Testing book');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryToDisplayShowView(AcceptanceTester $I): void
    {
        $I->amOnPage(self::URL);

        $I->click('//a[@href="/books/'.self::BOOK_ID.'"]');
        $I->see('Name: Testing book');
    }
}
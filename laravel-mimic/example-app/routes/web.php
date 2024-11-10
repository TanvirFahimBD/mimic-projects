<?php

use App\Http\Controllers\EloquentORMController;
use App\Http\Controllers\QueryBuilderController;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\DemoMiddleware;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\SessionMiddlewareController;
use App\Http\Controllers\ResourceController;

//DemoController
Route::get('/', [DemoController::class, 'ViewPage1']);
Route::get('/viewPage2', [DemoController::class, 'ViewPage2']);
Route::get('/invoke', DemoController::class);
Route::get('/getString', [DemoController::class, 'GetString']);

Route::get('/getParameterByUrl/{email}/{name}', [DemoController::class, 'GetParameterByUrl']);
Route::post('/postParameterByBody', [DemoController::class, 'PostParameterByBody']);
Route::post('/postParameterByHeader', [DemoController::class, 'PostParameterByHeader']);
Route::post('/postAll/{age}', [DemoController::class, 'PostAll']);
Route::post('/postFormData', [DemoController::class, 'PostFormData']);
Route::post('/postFormDataFile', [DemoController::class, 'PostFormDataFile']);
Route::post('/postFormDataFileStoreMove', [DemoController::class, 'PostFormDataFileStoreMove']);
Route::post('/headerMis', [DemoController::class, 'HeaderMis']);
Route::post('/cookieRequest', [DemoController::class, 'CookieRequest']);

Route::get('/misResponse', [DemoController::class, 'MisResponse']);
Route::get('/jSONRes', [DemoController::class, 'JSONRes']);
Route::get('/redirectRes1', [DemoController::class, 'RedirectRes1']);
Route::get('/redirectRes2', [DemoController::class, 'RedirectRes2']);
Route::get('/binaryView', [DemoController::class, 'BinaryView']);
Route::get('/binaryDownload', [DemoController::class, 'BinaryDownload']);
Route::get('/cookieResponse', [DemoController::class, 'CookieResponse']);
Route::get('/headerResponse', [DemoController::class, 'HeaderResponse']);

//SessionMiddlewareController
Route::get('/LogAction/{num1}/{num2}', [SessionMiddlewareController::class, 'LogAction']);
Route::get('/SessionPUT/{email}', [SessionMiddlewareController::class, 'SessionPUT']);
Route::get('/SessionPULL', [SessionMiddlewareController::class, 'SessionPULL']);
Route::get('/SessionGET', [SessionMiddlewareController::class, 'SessionGET']);
Route::get('/SessionForget', [SessionMiddlewareController::class, 'SessionForget']);
Route::get('/SessionFlush', [SessionMiddlewareController::class, 'SessionFlush']);
//Route::get('/MiddleWareTest', [SessionMiddlewareController::class, 'MiddleWareTest'])->middleware([DemoMiddleware::class]);

Route::middleware(['demo'])->group(function () {
    Route::get('/MiddleWareTest', [SessionMiddlewareController::class, 'MiddleWareTest']);
    Route::get('/MiddleWareTest2', [SessionMiddlewareController::class, 'MiddleWareTest2']);
});

Route::get('/RequestLimit', [SessionMiddlewareController::class, 'RequestLimit'])->middleware('throttle:5,1');
Route::resource('resource', ResourceController::class);

//Query Builder
Route::get('/GetAllProducts', [QueryBuilderController::class, 'GetAllProducts']);
Route::get('/GetSingleProduct', [QueryBuilderController::class, 'GetSingleProduct']);
Route::get('/GetSingleProductPluck', [QueryBuilderController::class, 'GetSingleProductPluck']);
Route::get('/Aggregate', [QueryBuilderController::class, 'Aggregate']);
Route::get('/SelectColumn', [QueryBuilderController::class, 'SelectColumn']);
Route::get('/InnerJoin', [QueryBuilderController::class, 'InnerJoin']);
Route::get('/AdvanceJoin', [QueryBuilderController::class, 'AdvanceJoin']);
Route::get('/WhereClause', [QueryBuilderController::class, 'WhereClause']);
Route::get('/OrderByClause', [QueryBuilderController::class, 'OrderByClause']);
Route::get('/GroupByHavingClause', [QueryBuilderController::class, 'GroupByHavingClause']);
Route::get('/SkipLimitClause', [QueryBuilderController::class, 'SkipLimitClause']);
Route::get('/InsertBrand', [QueryBuilderController::class, 'InsertBrand']);
Route::get('/InsertRequestFromBody', [QueryBuilderController::class, 'InsertRequestFromBody']);
Route::get('/UpdateRequestBodyUrl/{id}', [QueryBuilderController::class, 'UpdateRequestBodyUrl']);
Route::get('/UpdateOrInsertRequest', [QueryBuilderController::class, 'UpdateOrInsertRequest']);
Route::get('/DeleteRequest/{id}', [QueryBuilderController::class, 'DeleteRequest']);


//Eloquent ORM
Route::get('/CreateBrandEORM', [EloquentORMController::class, 'CreateBrandEORM']);
Route::get('/UpdateBrandEORM/{id}', [EloquentORMController::class, 'UpdateBrandEORM']);
Route::get('/UpdateOrCreateRequestEORM', [EloquentORMController::class, 'UpdateOrCreateRequestEORM']);
Route::get('/DeleteRequestEORM/{id}', [EloquentORMController::class, 'DeleteRequestEORM']);
Route::get('/GetAllBrandsEORM', [EloquentORMController::class, 'GetAllBrandsEORM']);
Route::get('/GetSingleBrandEORM', [EloquentORMController::class, 'GetSingleBrandEORM']);
Route::get('/GetListOfColumnEORM', [EloquentORMController::class, 'GetListOfColumnEORM']);
Route::get('/AggregateEORM', [EloquentORMController::class, 'AggregateEORM']);
Route::get('/SelectColumnEORM', [EloquentORMController::class, 'SelectColumnEORM']);
Route::get('/WhereClauseEORM', [EloquentORMController::class, 'WhereClauseEORM']);
Route::get('/OrderByClauseEORM', [EloquentORMController::class, 'OrderByClauseEORM']);
Route::get('/PaginationEORM', [EloquentORMController::class, 'PaginationEORM']);
Route::get('/OneOneUserEORM', [EloquentORMController::class, 'OneOneUserEORM']);
Route::get('/OneOneRevProfileEORM', [EloquentORMController::class, 'OneOneRevProfileEORM']);
Route::get('/OneManyBrandEORM', [EloquentORMController::class, 'OneManyBrandEORM']);
Route::get('/OneOneProductEORM', [EloquentORMController::class, 'OneOneProductEORM']);

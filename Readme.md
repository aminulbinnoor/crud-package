# Laravel CRUD Generator Package

A simple Laravel 8.* library that allows you to create crud operations with a single command

## Installation
```
composer require aminul/crudgenerator
```
## Features

* Controller (with all the code already written)
* Model
* Migration
* Requests
* Routes

## Enable the package (Optional)
This package implements Laravel auto-discovery feature. After you install it the package provider and facade are added automatically

## Configuration
Publish the configuration file

This step is required

```
php artisan vendor:publish --provider="Aminul\CrudGenerator\CrudGeneratorServiceProvider"
```

## Usage

After publishing the configuration file just run the below command

```
php artisan make:crud ModelName
```

Just it, Now all of your `Model Controller, Migration, routes` and `Request` will be created automatically with all the code required for basic crud operations

## Example

```angular2
php artisan make:crud Product
```
#### ProductController.php
```angular2
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        $Products = Product::latest()->get();

        return response()->json($Products, 201);
    }

    public function store(ProductRequest $request)
    {
        $Product = Product::create($request->all());

        return response()->json($Product, 201);
    }

    public function show($id)
    {
        $Product = Product::findOrFail($id);

        return response()->json($Product);
    }

    public function update(ProductRequest $request, $id)
    {
        $Product = Product::findOrFail($id);
        $Product->update($request->all());

        return response()->json($Product, 200);
    }

    public function destroy($id)
    {
        Product::destroy($id);

        return response()->json(null, 204);
    }
}
```

#### Product.php
```angular2
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];
}
```

#### ProductRequest.php
```angular2
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }
}
```

#### products table migration
```angular2
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
``` 

#### Routes/web.php
```angular2
Route::resource('products', 'ProductController'); 
```

##### Now all of your basic apis are ready to use you can use them directly by just adding fields in your table


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pizza;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    // pizza page
    public function pizza()
    {
        if (Session::has('PIZZA_SEARCH')) {
            Session::forget('PIZZA_SEARCH');
        }

        $data = Pizza::paginate(5);

        if (count($data) == 0) {
            $emptyStatus = 0;
        } else {
            $emptyStatus = 1;
        }

        return view('admin.pizza.list')->with(['pizza' => $data, 'status' => $emptyStatus]);
    }

    // create pizza page
    public function createPizza()
    {
        $category = Category::get();

        return view('admin.pizza.createPizza')->with(['category' => $category]);

    }

    // insert pizza
    public function insertPizza(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'publish' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'buyOneGetOne' => 'required',
            'waitingTime' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $file = $request->file('image');
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path() . '/uploads', $fileName);

        $data = $this->requestPizzaData($request, $fileName);

        Pizza::create($data);

        return redirect()->route('admin#pizza')->with(['createSuccess' => "Pizza Created"]);
    }

    // delete pizza
    public function deletePizza($id)
    {
        $data = Pizza::select('image')
            ->where('pizza_id', $id)
            ->first();

        $fileName = $data['image'];

        Pizza::where('pizza_id', $id)->delete();

        if (File::exists(public_path() . '/uploads/' . $fileName)) {
            File::delete(public_path() . '/uploads/' . $fileName);
        }

        return back()->with(['deletePizza' => "Pizza Deleted!"]);
    }

    // pizza info
    public function infoPizza($id)
    {
        $data = Pizza::where('pizza_id', $id)->first();
        return view('admin.pizza.info')->with(['pizza' => $data]);
    }

    // update pizza page
    public function updatePizzaPage($id)
    {
        $category = Category::get();

        $data = Pizza::select('pizzas.*', 'categories.category_id', 'categories.category_name')
            ->join('categories', 'pizzas.category_id', 'categories.category_id')
            ->where('pizza_id', $id)
            ->first();
        return view('admin.pizza.editPizza')->with(['pizza' => $data, 'category' => $category]);
    }

    // update pizza
    public function updatePizza($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'publish' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'buyOneGetOne' => 'required',
            'waitingTime' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->requestUpdatePizzaData($request);
        $updateData = $this->requestUpdatePizzaData($request);

        if (isset($updateData['image'])) {
            // get old image name
            $data = Pizza::select('image')
                ->where('pizza_id', $id)
                ->first();

            $fileName = $data['image'];

            // delete old image
            if (File::exists(public_path() . '/uploads/' . $fileName)) {
                File::delete(public_path() . '/uploads/' . $fileName);
            }

            // get new image
            $file = $request->file('image');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $fileName);

            $updateData['image'] = $fileName;

            // update
            // Pizza::where('pizza_id', $id)->update($updateData);
            // return redirect()->route('admin#pizza')->with(['pizzaUpdate' => 'Update Success']);
        }
        Pizza::where('pizza_id', $id)->update($updateData);
        return redirect()->route('admin#pizza')->with(['pizzaUpdate' => 'Update Success']);

    }

    // search pizza
    public function searchPizza(Request $request)
    {
        $searchKey = $request->table_search;
        $searchData = Pizza::orWhere('pizza_name', 'like', '%' . $searchKey . '%')
            ->orWhere('price', $searchKey)
            ->paginate(5);
        $searchData->appends($request->all());
        if (count($searchData) == 0) {
            $emptyStatus = 0;
        } else {
            $emptyStatus = 1;
        }

        Session::put('PIZZA_SEARCH', $searchKey);

        return view('admin.pizza.list')->with(['pizza' => $searchData, 'status' => $emptyStatus]);
    }

    // look category
    public function categoryItem($id)
    {
        $data = Pizza::select('pizzas.*', 'categories.category_name as categoryName')
            ->join('categories', 'categories.category_id', 'pizzas.category_id')
            ->where('pizzas.category_id', $id)
            ->paginate(5);

        return view('admin.catgory.item')->with(['pizza' => $data]);

    }

    public function pizzaDownload()
    {
        if (Session::has('PIZZA_SEARCH')) {
            $pizza = Pizza::orWhere('pizza_name', 'like', '%' . Session::get('PIZZA_SEARCH') . '%')
                ->orWhere('price', Session::get('PIZZA_SEARCH'))
                ->get();
        } else {
            $pizza = Pizza::get();
        }

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($pizza, [
            'pizza_id' => 'Id',
            'pizza_name' => 'Name',
            'price' => 'Price',
            'publish_status' => 'Publish Status',
            'discount_price' => 'Discount Price',
            'buy_one_get_one_status' => 'Buy One Get One Status',
            'waiting_time' => 'Waiting Time',
        ]);

        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'pizzaList.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');

    }

    private function requestUpdatePizzaData($request)
    {
        $arr = [
            'pizza_name' => $request->name,
            // 'image' => $fileName,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOneGetOne,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        if (isset($request->image)) {
            $arr['image'] = $request->image;
        }

        return $arr;
    }

    private function requestPizzaData($request, $fileName)
    {
        return [
            'pizza_name' => $request->name,
            'image' => $fileName,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOneGetOne,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

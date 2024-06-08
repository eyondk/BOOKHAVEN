<?php

class ItemsDetailsSuperadmin extends Controller
{
    public function index()
    {
        $item_cat = new ItemCategory();
        $item_size = new ItemSize();
        $item_color = new ItemColor();
        $data = [];
        
        $categories = $item_cat->getAllCategories();
        $data['categories'] = $categories;

        $sizes = $item_size->getAllSizes();
        $data['sizes'] = $sizes;

        $colors = $item_color->getAllColors();
        $data['colors'] = $colors;
        
        // print_r($categories);
        // print_r($sizes);
        // print_r($colors);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = array_merge($data, $_POST);
            if (isset($_POST['add_category'])) {
                $item_cat->insert_category($data);
            } 
            else if (isset($_POST['add_size'])) {
                $item_size->insert_size($data);
            }
            else if (isset($_POST['add_color'])) {
                $item_color->insert_color($data);
            }

            if (isset($_POST['del_cat'])) {
                $item_cat->delete_category($data);
            } 
            else if (isset($_POST['del_size'])) {
                $item_size->delete_size($data);
            }
            else if (isset($_POST['del_col'])) {
                $item_color->delete_color($data);
            }

            $data['errors'] = array_merge(
                $item_cat->errors,
                $item_size->errors,
                $item_color->errors
            );
            // redirect('itemsdetailssuperadmin');
        }

        $this->view('superadmin/items-details-superadmin', $data);
    }
}

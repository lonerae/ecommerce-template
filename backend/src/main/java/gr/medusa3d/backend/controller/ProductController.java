package gr.medusa3d.backend.controller;

import gr.medusa3d.backend.model.Product;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.ArrayList;
import java.util.List;

@RestController
@RequestMapping(path="api/product")
public class ProductController {

    @GetMapping
    public List<Product> getProducts() {
        ArrayList<Product> productList = new ArrayList<>();
        productList.add(new Product(1,"test",10,"texttexttexttext","https://via.placeholder.com/150"));

        return productList;
    }
}

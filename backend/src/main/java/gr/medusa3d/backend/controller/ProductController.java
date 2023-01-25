package gr.medusa3d.backend.controller;

import gr.medusa3d.backend.model.Product;
import gr.medusa3d.backend.service.ProductService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@CrossOrigin(origins = "http://localhost:4200")
@RequestMapping(path="api/product")
public class ProductController {

    private final ProductService productService;

    @Autowired
    public ProductController(ProductService productService){
        this.productService = productService;
    }
    @GetMapping
    public List<Product> getProducts(@RequestParam(name="sort", required = false) String sort,
                                     @RequestParam(name="limit", required = false) Integer limit) {
        return this.productService.getProducts(sort, limit);
    }

    @GetMapping(path = "/category/{category}")
    public List<Product> getProducts(@PathVariable(value = "category") String category,
                                     @RequestParam(name="sort", required = false) String sort,
                                     @RequestParam(name="limit", required = false) Integer limit) {
        return this.productService.getProducts(category, sort, limit);
    }

    @GetMapping({"/category","/category/"})
    public List<String> getCategories() {
            return this.productService.getCategories();
    }


}

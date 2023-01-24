package gr.medusa3d.backend.service;

import gr.medusa3d.backend.model.Category;
import gr.medusa3d.backend.model.Product;
import gr.medusa3d.backend.repository.CategoryRepository;
import gr.medusa3d.backend.repository.ProductRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class ProductService {

    private final ProductRepository productRepository;
    private final CategoryRepository categoryRepository;

    @Autowired
    public ProductService(ProductRepository productRepository, CategoryRepository categoryRepository) {
        this.productRepository = productRepository;
        this.categoryRepository = categoryRepository;
    }
    public List<Product> getProducts() {
       return  this.productRepository.findAll();
    }

    public List<Product> getProducts(String category) {
        return this.getProducts()
                .stream()
                .filter(product ->
                {
                    boolean flag = false;
                    for (Category c : product.getCategorySet()) {
                        flag = c.getName().equalsIgnoreCase(category);
                        if (flag) {
                            break;
                        }
                    }
                    return flag;
                })
                .toList();
    }

    public List<String> getCategories() {
        return this.categoryRepository.findAll()
                .stream()
                .map(Category::getName)
                .toList();
    }
}

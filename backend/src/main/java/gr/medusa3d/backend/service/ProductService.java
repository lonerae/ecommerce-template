package gr.medusa3d.backend.service;

import gr.medusa3d.backend.model.Category;
import gr.medusa3d.backend.model.Product;
import gr.medusa3d.backend.repository.CategoryRepository;
import gr.medusa3d.backend.repository.ProductRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Comparator;
import java.util.List;
import java.util.stream.Collectors;

@Service
public class ProductService {

    private final ProductRepository productRepository;
    private final CategoryRepository categoryRepository;

    @Autowired
    public ProductService(ProductRepository productRepository, CategoryRepository categoryRepository) {
        this.productRepository = productRepository;
        this.categoryRepository = categoryRepository;
    }
    public List<Product> getProducts(String sort, Integer limit) {
        return  queryResults(sort, limit, this.productRepository.findAll());
    }

    public List<Product> getProducts(String category, String sort, Integer limit) {
        return queryResults(sort, limit,
                this.productRepository.findAll()
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
                        .toList()
        );
    }

    private static List<Product> queryResults(String sort, Integer limit, List<Product> productList) {
        List<Product> productListWithWritePermission = new ArrayList<>(productList);
        if (sort != null) {
            switch (sort) {
                case "Ascending price" -> productListWithWritePermission.sort(Comparator.comparingInt(Product::getPrice));
                case "Descending price" -> productListWithWritePermission.sort((a, b) -> b.getPrice() - a.getPrice());
            }
        }

        if (limit != null) {
            productListWithWritePermission = productListWithWritePermission.stream().limit(limit).collect(Collectors.toList());
        }

        return productListWithWritePermission;
    }

    public List<String> getCategories() {
        return this.categoryRepository.findAll()
                .stream()
                .map(Category::getName)
                .toList();
    }
}

package gr.medusa3d.backend.service;

import gr.medusa3d.backend.model.Product;
import gr.medusa3d.backend.repository.ProductRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.math.BigDecimal;
import java.math.RoundingMode;
import java.util.ArrayList;
import java.util.List;

@Service
public class ProductService {

    private final ProductRepository productRepository;

    @Autowired
    public ProductService(ProductRepository productRepository) {
        this.productRepository = productRepository;
    }
    public List<Product> getProducts() {
        List<Product> productList = new ArrayList<>();
        for (Product p : this.productRepository.findAll()) {
            p.setPrice(p.getPrice().divide(BigDecimal.valueOf(100), 2, RoundingMode.FLOOR));
            productList.add(p);
        }
       return productList;
    }
}

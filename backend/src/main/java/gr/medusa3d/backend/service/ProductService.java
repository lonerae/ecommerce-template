package gr.medusa3d.backend.service;

import gr.medusa3d.backend.model.Product;
import gr.medusa3d.backend.repository.ProductRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class ProductService {

    private final ProductRepository productRepository;

    @Autowired
    public ProductService(ProductRepository productRepository) {
        this.productRepository = productRepository;
    }
    public List<Product> getProducts() {
       return this.productRepository.findAll();
    }
}

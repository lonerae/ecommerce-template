package gr.medusa3d.backend.model;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import jakarta.persistence.*;
import lombok.*;

import java.math.BigDecimal;
import java.util.Set;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
@Entity
@Table(name= "product")
public class Product {
    @Id
    @GeneratedValue(strategy= GenerationType.SEQUENCE,generator = "product_id_seq")
    @SequenceGenerator(name = "product_id_seq", sequenceName = "product_id_seq", allocationSize = 1)
    @Column(name = "id", nullable = false)
    private int id;
    private String title;
    private Integer price;
    @JsonIgnoreProperties("productSet")
    @ManyToMany
    @JoinTable(
            name = "productcategory",
            joinColumns = @JoinColumn(name = "product_id"),
            inverseJoinColumns = @JoinColumn(name = "category_id")
    )
    private Set<Category> categorySet;
    private String description;
    private String image;

    @Override
    public String toString() {
        return title;
    }
}

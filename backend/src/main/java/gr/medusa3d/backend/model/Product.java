package gr.medusa3d.backend.model;

import jakarta.persistence.Entity;
import jakarta.persistence.Table;
import lombok.*;

@Getter
@Setter
@ToString
@AllArgsConstructor
@NoArgsConstructor
//@Entity
//@Table(name= "product")
public class Product {
    private int id;
    private String title;
    private int price;
    private String description;
    private String image;
}

package gr.medusa3d.backend.model;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import jakarta.persistence.*;
import lombok.*;

import java.util.Set;


@Getter
@Setter
@ToString
@AllArgsConstructor
@NoArgsConstructor
@Entity
@Table(name= "category")
public class Category {
    @Id
    @GeneratedValue(strategy= GenerationType.SEQUENCE,generator = "category_id_seq")
    @SequenceGenerator(name = "category_id_seq", sequenceName = "category_id_seq", allocationSize = 1)
    @Column(name = "id", nullable = false)
    private int id;
    private String name;
    @JsonIgnoreProperties("categorySet")
    @ManyToMany(mappedBy = "categorySet")
    private Set<Product> productSet;
}

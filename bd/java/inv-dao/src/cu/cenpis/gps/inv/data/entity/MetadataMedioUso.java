/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package cu.cenpis.gps.inv.data.entity;

import java.io.Serializable;
import javax.persistence.Basic;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.NamedQueries;
import javax.persistence.NamedQuery;
import javax.persistence.Table;
import javax.validation.constraints.NotNull;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author Felipe
 */
@Entity
@Table(name = "metadata_medio_uso", catalog = "invsf57", schema = "")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "MetadataMedioUso.findAll", query = "SELECT m FROM MetadataMedioUso m")
    , @NamedQuery(name = "MetadataMedioUso.findById", query = "SELECT m FROM MetadataMedioUso m WHERE m.id = :id")
    , @NamedQuery(name = "MetadataMedioUso.findByTotalMedioUso", query = "SELECT m FROM MetadataMedioUso m WHERE m.totalMedioUso = :totalMedioUso")
    , @NamedQuery(name = "MetadataMedioUso.findByImporteTotalCuc", query = "SELECT m FROM MetadataMedioUso m WHERE m.importeTotalCuc = :importeTotalCuc")
    , @NamedQuery(name = "MetadataMedioUso.findByImporteTotalCup", query = "SELECT m FROM MetadataMedioUso m WHERE m.importeTotalCup = :importeTotalCup")})
public class MetadataMedioUso implements Serializable {

    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(nullable = false)
    private Long id;
    @Basic(optional = false)
    @NotNull
    @Column(name = "total_medio_uso", nullable = false)
    private int totalMedioUso;
    @Basic(optional = false)
    @NotNull
    @Column(name = "importe_total_cuc", nullable = false)
    private double importeTotalCuc;
    @Basic(optional = false)
    @NotNull
    @Column(name = "importe_total_cup", nullable = false)
    private double importeTotalCup;
    @JoinColumn(name = "revision_mu", referencedColumnName = "id", nullable = false)
    @ManyToOne(optional = false)
    private RevisionMedioUso revisionMedioUso;

    public MetadataMedioUso() {
    }

    public MetadataMedioUso(Long id) {
        this.id = id;
    }

    public MetadataMedioUso(Long id, int totalMedioUso, double importeTotalCuc, double importeTotalCup) {
        this.id = id;
        this.totalMedioUso = totalMedioUso;
        this.importeTotalCuc = importeTotalCuc;
        this.importeTotalCup = importeTotalCup;
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public int getTotalMedioUso() {
        return totalMedioUso;
    }

    public void setTotalMedioUso(int totalMedioUso) {
        this.totalMedioUso = totalMedioUso;
    }

    public double getImporteTotalCuc() {
        return importeTotalCuc;
    }

    public void setImporteTotalCuc(double importeTotalCuc) {
        this.importeTotalCuc = importeTotalCuc;
    }

    public double getImporteTotalCup() {
        return importeTotalCup;
    }

    public void setImporteTotalCup(double importeTotalCup) {
        this.importeTotalCup = importeTotalCup;
    }

    public RevisionMedioUso getRevisionMedioUso() {
        return revisionMedioUso;
    }

    public void setRevisionMedioUso(RevisionMedioUso revisionMedioUso) {
        this.revisionMedioUso = revisionMedioUso;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (id != null ? id.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof MetadataMedioUso)) {
            return false;
        }
        MetadataMedioUso other = (MetadataMedioUso) object;
        if ((this.id == null && other.id != null) || (this.id != null && !this.id.equals(other.id))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "cu.cenpis.gps.inv.data.entity.MetadataMedioUso[ id=" + id + " ]";
    }
    
}

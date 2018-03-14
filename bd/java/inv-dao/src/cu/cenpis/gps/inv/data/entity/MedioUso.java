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
import javax.persistence.Lob;
import javax.persistence.ManyToOne;
import javax.persistence.NamedQueries;
import javax.persistence.NamedQuery;
import javax.persistence.Table;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author Felipe
 */
@Entity
@Table(name = "medio_uso", catalog = "invsf57", schema = "")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "MedioUso.findAll", query = "SELECT m FROM MedioUso m")
    , @NamedQuery(name = "MedioUso.findById", query = "SELECT m FROM MedioUso m WHERE m.id = :id")
    , @NamedQuery(name = "MedioUso.findByRotulo", query = "SELECT m FROM MedioUso m WHERE m.rotulo = :rotulo")
    , @NamedQuery(name = "MedioUso.findByResponsableText", query = "SELECT m FROM MedioUso m WHERE m.responsableText = :responsableText")
    , @NamedQuery(name = "MedioUso.findByResponsableNomina", query = "SELECT m FROM MedioUso m WHERE m.responsableNomina = :responsableNomina")
    , @NamedQuery(name = "MedioUso.findByCantidad", query = "SELECT m FROM MedioUso m WHERE m.cantidad = :cantidad")
    , @NamedQuery(name = "MedioUso.findByCantidadSubTotalUtil", query = "SELECT m FROM MedioUso m WHERE m.cantidadSubTotalUtil = :cantidadSubTotalUtil")
    , @NamedQuery(name = "MedioUso.findByPrecioCup", query = "SELECT m FROM MedioUso m WHERE m.precioCup = :precioCup")
    , @NamedQuery(name = "MedioUso.findByImporteCup", query = "SELECT m FROM MedioUso m WHERE m.importeCup = :importeCup")
    , @NamedQuery(name = "MedioUso.findByImporteCupSubtotalUtil", query = "SELECT m FROM MedioUso m WHERE m.importeCupSubtotalUtil = :importeCupSubtotalUtil")
    , @NamedQuery(name = "MedioUso.findByPrecioCuc", query = "SELECT m FROM MedioUso m WHERE m.precioCuc = :precioCuc")
    , @NamedQuery(name = "MedioUso.findByImporteCuc", query = "SELECT m FROM MedioUso m WHERE m.importeCuc = :importeCuc")
    , @NamedQuery(name = "MedioUso.findByImporteCucSubtotalUtil", query = "SELECT m FROM MedioUso m WHERE m.importeCucSubtotalUtil = :importeCucSubtotalUtil")})
public class MedioUso implements Serializable {

    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(nullable = false)
    private Long id;
    @Basic(optional = false)
    @NotNull
    @Size(min = 1, max = 50)
    @Column(nullable = false, length = 50)
    private String rotulo;
    @Basic(optional = false)
    @NotNull
    @Lob
    @Size(min = 1, max = 65535)
    @Column(nullable = false, length = 65535)
    private String descripcion;
    @Basic(optional = false)
    @NotNull
    @Size(min = 1, max = 255)
    @Column(name = "responsable_text", nullable = false, length = 255)
    private String responsableText;
    @Basic(optional = false)
    @NotNull
    @Size(min = 1, max = 50)
    @Column(name = "responsable_nomina", nullable = false, length = 50)
    private String responsableNomina;
    @Basic(optional = false)
    @NotNull
    @Column(nullable = false)
    private int cantidad;
    @Basic(optional = false)
    @NotNull
    @Column(name = "cantidad_sub_total_util", nullable = false)
    private int cantidadSubTotalUtil;
    @Basic(optional = false)
    @NotNull
    @Column(name = "precio_cup", nullable = false)
    private double precioCup;
    @Basic(optional = false)
    @NotNull
    @Column(name = "importe_cup", nullable = false)
    private double importeCup;
    @Basic(optional = false)
    @NotNull
    @Column(name = "importe_cup_subtotal_util", nullable = false)
    private double importeCupSubtotalUtil;
    @Basic(optional = false)
    @NotNull
    @Column(name = "precio_cuc", nullable = false)
    private double precioCuc;
    @Basic(optional = false)
    @NotNull
    @Column(name = "importe_cuc", nullable = false)
    private double importeCuc;
    @Basic(optional = false)
    @NotNull
    @Column(name = "importe_cuc_subtotal_util", nullable = false)
    private double importeCucSubtotalUtil;
    @JoinColumn(name = "revision_mu", referencedColumnName = "id", nullable = false)
    @ManyToOne(optional = false)
    private RevisionMedioUso revisionMedioUso;

    public MedioUso() {
    }

    public MedioUso(Long id) {
        this.id = id;
    }

    public MedioUso(/*Long id,*/ String rotulo, String descripcion, String responsableText, String responsableNomina, int cantidad, int cantidadSubTotalUtil,
            double precioCup, double importeCup, double importeCupSubtotalUtil, double precioCuc, double importeCuc, double importeCucSubtotalUtil, RevisionMedioUso revisionMedioUso) {
        //this.id = id;
        this.rotulo = rotulo;
        this.descripcion = descripcion;
        this.responsableText = responsableText;
        this.responsableNomina = responsableNomina;
        this.cantidad = cantidad;
        this.cantidadSubTotalUtil = cantidadSubTotalUtil;
        this.precioCup = precioCup;
        this.importeCup = importeCup;
        this.importeCupSubtotalUtil = importeCupSubtotalUtil;
        this.precioCuc = precioCuc;
        this.importeCuc = importeCuc;
        this.importeCucSubtotalUtil = importeCucSubtotalUtil;
        this.revisionMedioUso = revisionMedioUso;
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getRotulo() {
        return rotulo;
    }

    public void setRotulo(String rotulo) {
        this.rotulo = rotulo;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public String getResponsableText() {
        return responsableText;
    }

    public void setResponsableText(String responsableText) {
        this.responsableText = responsableText;
    }

    public String getResponsableNomina() {
        return responsableNomina;
    }

    public void setResponsableNomina(String responsableNomina) {
        this.responsableNomina = responsableNomina;
    }

    public int getCantidad() {
        return cantidad;
    }

    public void setCantidad(int cantidad) {
        this.cantidad = cantidad;
    }

    public int getCantidadSubTotalUtil() {
        return cantidadSubTotalUtil;
    }

    public void setCantidadSubTotalUtil(int cantidadSubTotalUtil) {
        this.cantidadSubTotalUtil = cantidadSubTotalUtil;
    }

    public double getPrecioCup() {
        return precioCup;
    }

    public void setPrecioCup(double precioCup) {
        this.precioCup = precioCup;
    }

    public double getImporteCup() {
        return importeCup;
    }

    public void setImporteCup(double importeCup) {
        this.importeCup = importeCup;
    }

    public double getImporteCupSubtotalUtil() {
        return importeCupSubtotalUtil;
    }

    public void setImporteCupSubtotalUtil(double importeCupSubtotalUtil) {
        this.importeCupSubtotalUtil = importeCupSubtotalUtil;
    }

    public double getPrecioCuc() {
        return precioCuc;
    }

    public void setPrecioCuc(double precioCuc) {
        this.precioCuc = precioCuc;
    }

    public double getImporteCuc() {
        return importeCuc;
    }

    public void setImporteCuc(double importeCuc) {
        this.importeCuc = importeCuc;
    }

    public double getImporteCucSubtotalUtil() {
        return importeCucSubtotalUtil;
    }

    public void setImporteCucSubtotalUtil(double importeCucSubtotalUtil) {
        this.importeCucSubtotalUtil = importeCucSubtotalUtil;
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
        if (!(object instanceof MedioUso)) {
            return false;
        }
        MedioUso other = (MedioUso) object;
        if ((this.id == null && other.id != null) || (this.id != null && !this.id.equals(other.id))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "cu.cenpis.gps.inv.data.entity.MedioUso[ id=" + id + " ]";
    }
    
}

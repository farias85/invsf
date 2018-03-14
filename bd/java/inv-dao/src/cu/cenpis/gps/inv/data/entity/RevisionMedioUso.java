/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package cu.cenpis.gps.inv.data.entity;

import java.io.Serializable;
import java.util.Date;
import java.util.Set;
import javax.persistence.Basic;
import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.NamedQueries;
import javax.persistence.NamedQuery;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.persistence.Temporal;
import javax.persistence.TemporalType;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;

/**
 *
 * @author Felipe
 */
@Entity
@Table(name = "revision_medio_uso", catalog = "invsf", schema = "")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "RevisionMedioUso.findAll", query = "SELECT r FROM RevisionMedioUso r")
    , @NamedQuery(name = "RevisionMedioUso.findById", query = "SELECT r FROM RevisionMedioUso r WHERE r.id = :id")
    , @NamedQuery(name = "RevisionMedioUso.findByActivo", query = "SELECT r FROM RevisionMedioUso r WHERE r.activo = :activo")
    , @NamedQuery(name = "RevisionMedioUso.findByFechaEnSistema", query = "SELECT r FROM RevisionMedioUso r WHERE r.fechaEnSistema = :fechaEnSistema")
    , @NamedQuery(name = "RevisionMedioUso.findByFechaExcel", query = "SELECT r FROM RevisionMedioUso r WHERE r.fechaExcel = :fechaExcel")
    , @NamedQuery(name = "RevisionMedioUso.findByExcelUrl", query = "SELECT r FROM RevisionMedioUso r WHERE r.excelUrl = :excelUrl")})
public class RevisionMedioUso implements Serializable {

    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(nullable = false)
    private Long id;
    @Basic(optional = false)
    @NotNull
    @Column(nullable = false)
    private boolean activo;
    @Basic(optional = false)
    @NotNull
    @Column(name = "fecha_en_sistema", nullable = false)
    @Temporal(TemporalType.DATE)
    private Date fechaEnSistema;
    @Basic(optional = false)
    @NotNull
    @Column(name = "fecha_excel", nullable = false)
    @Temporal(TemporalType.DATE)
    private Date fechaExcel;
    @Basic(optional = false)
    @NotNull
    @Size(min = 1, max = 500)
    @Column(name = "excel_url", nullable = false, length = 500)
    private String excelUrl;
    @OneToMany(cascade = CascadeType.ALL, mappedBy = "revisionMedioUso")
    private Set<MetadataMedioUso> metadataMedioUsoSet;
    @OneToMany(cascade = CascadeType.ALL, mappedBy = "revisionMedioUso")
    private Set<MedioUso> medioUsoSet;

    public RevisionMedioUso() {
    }

    public RevisionMedioUso(Long id) {
        this.id = id;
    }

    public RevisionMedioUso(/*Long id,*/ boolean activo, Date fechaEnSistema, Date fechaExcel, String excelUrl) {
        //this.id = id;
        this.activo = activo;
        this.fechaEnSistema = fechaEnSistema;
        this.fechaExcel = fechaExcel;
        this.excelUrl = excelUrl;
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public boolean getActivo() {
        return activo;
    }

    public void setActivo(boolean activo) {
        this.activo = activo;
    }

    public Date getFechaEnSistema() {
        return fechaEnSistema;
    }

    public void setFechaEnSistema(Date fechaEnSistema) {
        this.fechaEnSistema = fechaEnSistema;
    }

    public Date getFechaExcel() {
        return fechaExcel;
    }

    public void setFechaExcel(Date fechaExcel) {
        this.fechaExcel = fechaExcel;
    }

    public String getExcelUrl() {
        return excelUrl;
    }

    public void setExcelUrl(String excelUrl) {
        this.excelUrl = excelUrl;
    }

    @XmlTransient
    public Set<MetadataMedioUso> getMetadataMedioUsoSet() {
        return metadataMedioUsoSet;
    }

    public void setMetadataMedioUsoSet(Set<MetadataMedioUso> metadataMedioUsoSet) {
        this.metadataMedioUsoSet = metadataMedioUsoSet;
    }

    @XmlTransient
    public Set<MedioUso> getMedioUsoSet() {
        return medioUsoSet;
    }

    public void setMedioUsoSet(Set<MedioUso> medioUsoSet) {
        this.medioUsoSet = medioUsoSet;
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
        if (!(object instanceof RevisionMedioUso)) {
            return false;
        }
        RevisionMedioUso other = (RevisionMedioUso) object;
        if ((this.id == null && other.id != null) || (this.id != null && !this.id.equals(other.id))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "cu.cenpis.gps.inv.data.entity.RevisionMedioUso[ id=" + id + " ]";
    }
    
}

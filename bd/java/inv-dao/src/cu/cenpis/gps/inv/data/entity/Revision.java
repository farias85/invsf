/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package cu.cenpis.gps.inv.data.entity;

import java.io.Serializable;
import java.util.Date;
import java.util.List;
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
 * @author farias-i5
 */
@Entity
@Table(schema = "")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "Revision.findAll", query = "SELECT r FROM Revision r"),
    @NamedQuery(name = "Revision.findByIdRevision", query = "SELECT r FROM Revision r WHERE r.idRevision = :idRevision"),
    @NamedQuery(name = "Revision.findByActivo", query = "SELECT r FROM Revision r WHERE r.activo = :activo"),
    @NamedQuery(name = "Revision.findByFechaEnSistema", query = "SELECT r FROM Revision r WHERE r.fechaEnSistema = :fechaEnSistema"),
    @NamedQuery(name = "Revision.findByFechaExcel", query = "SELECT r FROM Revision r WHERE r.fechaExcel = :fechaExcel"),
    @NamedQuery(name = "Revision.findByExcelUrl", query = "SELECT r FROM Revision r WHERE r.excelUrl = :excelUrl")})
public class Revision implements Serializable {
    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    @Basic(optional = false)
    @Column(name = "id_revision")
    private Long idRevision;
    @Basic(optional = false)
    @NotNull
    private Boolean activo;
    @Basic(optional = false)
    @NotNull
    @Column(name = "fecha_en_sistema")
    @Temporal(TemporalType.DATE)
    private Date fechaEnSistema;
    @Basic(optional = false)
    @NotNull
    @Column(name = "fecha_excel")
    @Temporal(TemporalType.DATE)
    private Date fechaExcel;
    @Basic(optional = false)
    @NotNull
    @Size(min = 1, max = 500)
    @Column(name = "excel_url")
    private String excelUrl;
    @OneToMany(cascade = CascadeType.ALL, mappedBy = "revision")
    private List<Metadata> metadataList;
    @OneToMany(cascade = CascadeType.ALL, mappedBy = "revision")
    private List<ActivoFijo> activoFijoList;

    public Revision() {
    }

    public Revision(Boolean activo, Date fechaEnSistema, Date fechaExcel, String excelUrl) {
        this.activo = activo;
        this.fechaEnSistema = fechaEnSistema;
        this.fechaExcel = fechaExcel;
        this.excelUrl = excelUrl;
    }

    public Long getIdRevision() {
        return idRevision;
    }

    public void setIdRevision(Long idRevision) {
        this.idRevision = idRevision;
    }

    public Boolean getActivo() {
        return activo;
    }

    public void setActivo(Boolean activo) {
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
    public List<Metadata> getMetadataList() {
        return metadataList;
    }

    public void setMetadataList(List<Metadata> metadataList) {
        this.metadataList = metadataList;
    }

    @XmlTransient
    public List<ActivoFijo> getActivoFijoList() {
        return activoFijoList;
    }

    public void setActivoFijoList(List<ActivoFijo> activoFijoList) {
        this.activoFijoList = activoFijoList;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (idRevision != null ? idRevision.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof Revision)) {
            return false;
        }
        Revision other = (Revision) object;
        if ((this.idRevision == null && other.idRevision != null) || (this.idRevision != null && !this.idRevision.equals(other.idRevision))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "cu.Revision[ idRevision=" + idRevision + " ]";
    }
    
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package cu.cenpis.gps.inv.read;

import cu.cenpis.gps.inv.data.entity.MedioUso;
import cu.cenpis.gps.inv.data.entity.RevisionMedioUso;
import cu.cenpis.gps.inv.data.entity.MetadataMedioUso;
import cu.cenpis.gps.inv.data.service.MedioUsoService;
import cu.cenpis.gps.inv.data.service.MetadataMedioUsoService;
import cu.cenpis.gps.inv.data.service.RevisionMedioUsoService;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JOptionPane;

/**
 *
 * @author vladimir
 */
public class MedioUsoExcel extends Excel {

    private int totalMedioUso;
    private float importeTotalCUP;
    private float importeTotalCUC;
    private Date fecha;

    private RevisionMedioUsoService revisionMedioUsoService;
    private MetadataMedioUsoService metadataMedioUsoService;
    private MedioUsoService medioUsoService;
    //private LocalService localService;
    //private EstadoService estadoService;
    //private ResponsableService responsableService;
    //private TipoActivoService tipoActivoService;
    //private ActivoFijoService activoFijoService;

    public MedioUsoExcel() {

        revisionMedioUsoService = (RevisionMedioUsoService) Context.getBean("revisionMedioUsoServiceImpl");
        metadataMedioUsoService = (MetadataMedioUsoService) Context.getBean("metadataMedioUsoServiceImpl");
        medioUsoService = (MedioUsoService) Context.getBean("medioUsoServiceImpl");
    }

    public int getTotalMedioUso() {
        return totalMedioUso;
    }

    public void setTotalMedioUso(int totalMedioUso) {
        this.totalMedioUso = totalMedioUso;
    }

    public float getImporteTotalCUP() {
        return importeTotalCUP;
    }

    public void setImporteTotalCUP(float importeTotalCUP) {
        this.importeTotalCUP = importeTotalCUP;
    }

    public float getImporteTotalCUC() {
        return importeTotalCUC;
    }

    public void setImporteTotalCUC(float importeTotalCUC) {
        this.importeTotalCUC = importeTotalCUC;
    }

    @Override
    public void readData() {
        if (getListaInfo().size() > 0) {
            if (getListaInfoRe().isEmpty()) {
                crearListaInfoRe(getListaInfo());
            }

            String str = getListaInfoRe().get(getListaInfoRe().size() - 1)[1];
            DateFormat formatter = new SimpleDateFormat("dd/MM/yyyy");
            try {
                fecha = formatter.parse(str);
            } catch (ParseException ex) {
                Logger.getLogger(ControllerExcel.class.getName()).log(Level.SEVERE, null, ex);
            }

            for (int j = getListaInfoRe().size() - 10; j < getListaInfoRe().size(); j++) {
                String[] listaInfoRe1 = getListaInfoRe().get(j);
                for (int i = 0; i < listaInfoRe1.length; i++) {
                    //if (j > 10) {
                    if (listaInfoRe1[i].contains("Total")) {
                        totalMedioUso = (int) Float.parseFloat(listaInfoRe1[i + 1]);
                        importeTotalCUP = Float.parseFloat(listaInfoRe1[i + 2]);
                        importeTotalCUC = Float.parseFloat(listaInfoRe1[i + 3]);
                    }
                    //}
                }
            }
        }
    }

    @Override
    public void crearRevision() {
        if (!getListaInfoRe().isEmpty()) {

            if (getListaInfoRe().size() % 3 == 0) {

                RevisionMedioUso revisionMedioUso = new RevisionMedioUso();
                revisionMedioUso.setActivo(true);
                List<RevisionMedioUso> revisiones = revisionMedioUsoService.findByExample(revisionMedioUso);
                Long idURev = null;//Última revisión activa

                if (revisiones.size() > 0) {
                    revisionMedioUso = revisionMedioUsoService.findByExample(revisionMedioUso).get(0);
                    idURev = revisiones.get(0).getId();
                    revisionMedioUso.setActivo(false);
                    revisionMedioUsoService.edit(revisionMedioUso);
                }

                revisionMedioUso = new RevisionMedioUso(true, new Date(), fecha, "Todavia");
                revisionMedioUsoService.create(revisionMedioUso);

                MetadataMedioUso metadataMedioUso = new MetadataMedioUso(totalMedioUso, importeTotalCUC, importeTotalCUP);
                metadataMedioUso.setRevisionMedioUso(revisionMedioUso);
                metadataMedioUsoService.create(metadataMedioUso);

                int cantAG = 0;

                try {

                    for (int i = 0; i < getListaInfoRe().size(); i += 3) {                      

                        MedioUso medioUso = new MedioUso(getListaInfoRe().get(i)[1], getListaInfoRe().get(i)[2], getListaInfoRe().get(i + 1)[2], getListaInfoRe().get(i + 1)[1],
                                (int)Float.parseFloat(getListaInfoRe().get(i + 1)[3]), (int)Float.parseFloat(getListaInfoRe().get(i + 2)[2]), Float.parseFloat(getListaInfoRe().get(i + 1)[4]),
                                Float.parseFloat(getListaInfoRe().get(i + 1)[5]), Float.parseFloat(getListaInfoRe().get(i + 2)[3]), Float.parseFloat(getListaInfoRe().get(i + 1)[6]),
                                Float.parseFloat(getListaInfoRe().get(i + 1)[7]), Float.parseFloat(getListaInfoRe().get(i + 2)[4]), revisionMedioUso);

                        medioUsoService.create(medioUso);
                        /*ActivoFijo activoFijo = new ActivoFijo(getListaInfoRe().get(i)[1], getListaInfoRe().get(i)[2], Float.parseFloat(getListaInfoRe().get(i)[3]),
                         Float.parseFloat(getListaInfoRe().get(i)[4]), Float.parseFloat(getListaInfoRe().get(i + 1)[3]), Float.parseFloat(getListaInfoRe().get(i + 1)[3]),
                         Float.parseFloat(getListaInfoRe().get(i)[5]), Float.parseFloat(getListaInfoRe().get(i + 1)[4]), Float.parseFloat(getListaInfoRe().get(i)[6]),
                         getListaInfoRe().get(i)[7], getListaInfoRe().get(i)[8], fechaA, fechaEA, estado, local, responsable, revision, tipoActivo);
                            
                         activoFijoService.create(activoFijo);*/
                        cantAG++;

                    }
                } catch (ArrayIndexOutOfBoundsException excepcion) {
                    JOptionPane.showMessageDialog(null, "Error en el formato del documento." + "\n" + "Tipo de medio en uso número: " + (cantAG + 1) + "\n"
                            + "Fila: " + getListaInfoRe().get(cantAG * 3)[0], "Error", JOptionPane.ERROR_MESSAGE);

                }
                if (cantAG != getListaInfoRe().size() / 3) {
                    revisionMedioUsoService.removeById(revisionMedioUso.getId());
                    if (idURev != null) {
                        revisionMedioUso = revisionMedioUsoService.find(idURev);
                        revisionMedioUso.setActivo(true);
                        revisionMedioUsoService.edit(revisionMedioUso);
                    }
                } else {
                    JOptionPane.showMessageDialog(null, cantAG + " Tipos de medios un uso insertados de  " + getListaInfoRe().size() / 3);
                }

            } else {
                JOptionPane.showMessageDialog(null, "Los datos no están completos. Verifique el filtro o el documento", "Error", JOptionPane.ERROR_MESSAGE);
            }
        } else {
            JOptionPane.showMessageDialog(null, "¡Debe cargar el excel primero!", "Información ", JOptionPane.INFORMATION_MESSAGE);
        }
    }
//}

}

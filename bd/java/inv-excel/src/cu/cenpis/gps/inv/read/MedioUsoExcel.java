/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package cu.cenpis.gps.inv.read;

import cu.cenpis.gps.inv.data.entity.RevisionMedioUso;
import cu.cenpis.gps.inv.data.entity.MetadataMedioUso;
import cu.cenpis.gps.inv.data.service.MetadataMedioUsoService;
import cu.cenpis.gps.inv.data.service.RevisionMedioUsoService;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author vladimir
 */
public class MedioUsoExcel extends Excel{

    private int totalMedioUso;
    private float importeTotalCUP;
    private float importeTotalCUC;
    
    
    private RevisionMedioUsoService revisionMedioUsoService;
    private MetadataMedioUsoService metadataMedioUsoService;
    //private LocalService localService;
    //private EstadoService estadoService;
    //private ResponsableService responsableService;
    //private TipoActivoService tipoActivoService;
    //private ActivoFijoService activoFijoService;
    
    public MedioUsoExcel() {
        
        revisionMedioUsoService = (RevisionMedioUsoService) Context.getBean("revisionMedioUsoServiceImpl");
        metadataMedioUsoService = (MetadataMedioUsoService) Context.getBean("metadataMedioUsoServiceImpl");
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

            for (int j = getListaInfoRe().size() - 10; j < getListaInfoRe().size(); j++) {
                String[] listaInfoRe1 = getListaInfoRe().get(j);
                for (int i = 0; i < listaInfoRe1.length; i++) {
                    //if (j > 10) {
                    if (listaInfoRe1[i].contains("Total")) {
                        totalMedioUso = (int) Float.parseFloat(listaInfoRe1[i + 1]);
                        importeTotalCUP =  (float) Float.parseFloat(listaInfoRe1[i + 2]);
                        importeTotalCUC =  (float) Float.parseFloat(listaInfoRe1[i + 3]);
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
                //RevisionService revisionService = (RevisionService) Context.getBean("revisionServiceImpl");

                RevisionMedioUso revision = new RevisionMedioUso();
                revision.setActivo(true);
                List<RevisionMedioUso> revisiones = revisionMedioUsoService.findByExample(revision);
                Long idURev = null;//Última revisión activa

                if (revisiones.size() > 0) {
                    revision = revisionMedioUsoService.findByExample(revision).get(0);
                    idURev = revisiones.get(0).getId();
                    revision.setActivo(false);
                    revisionMedioUsoService.edit(revision);
                }

                revision = new RevisionMedioUso(true, new Date(), new Date(), "Todavia");
                revisionMedioUsoService.create(revision);

                MetadataMedioUso metadata = new MetadataMedioUso(totalMedioUso, importeTotalCUC, importeTotalCUP);
                metadata.setTotalMedioUso(totalMedioUso);
                metadata.setImporteTotalCuc(importeTotalCUC);
                metadata.setImporteTotalCup(importeTotalCUP);
                metadataMedioUsoService.create(metadata);

                Local SinLocal = localService.find(0L);

                Estado SinEstado = estadoService.find(0L);

                Responsable SinResponsable = responsableService.find(0L);

                TipoActivo SinTipoActivo = tipoActivoService.find(0);

                Date fechaA = null;
                Date fechaEA = null;

                int cantAG = 0;

                try {

                    for (int i = 0; i < getListaInfoRe().size(); i += 2) {
                        DateFormat formatter = new SimpleDateFormat("dd/MM/yyyy");

                       // if (getListaInfoRe().get(i).length == 11 && getListaInfoRe().get(i + 1).length == 5) {
                            fechaA = formatter.parse(getListaInfoRe().get(i)[9]);
                            fechaEA = formatter.parse(getListaInfoRe().get(i)[10]);

                            Local local;
                            Estado estado;
                            Responsable responsable;
                            TipoActivo tipoActivo;

                            HashMap<String, Object> params = new HashMap<>();
                            params.put("mRotulo", getListaInfoRe().get(i)[1]);
                            params.put("idRevision", idURev);
                            List<ActivoFijo> activosFijos = activoFijoService.findNamedQuery("ActivoFijo.findRevision", params);

                            if (activosFijos.size() > 0) {

                                local = activosFijos.get(0).getLocal();
                                estado = activosFijos.get(0).getEstado();
                                responsable = activosFijos.get(0).getResponsable();
                                tipoActivo = activosFijos.get(0).getTipoActivo();

                            } else {
                                local = SinLocal;
                                estado = SinEstado;
                                responsable = SinResponsable;
                                tipoActivo = SinTipoActivo;
                            }

                            ActivoFijo activoFijo = new ActivoFijo(getListaInfoRe().get(i)[1], getListaInfoRe().get(i)[2], Float.parseFloat(getListaInfoRe().get(i)[3]),
                                    Float.parseFloat(getListaInfoRe().get(i)[4]), Float.parseFloat(getListaInfoRe().get(i + 1)[3]), Float.parseFloat(getListaInfoRe().get(i + 1)[3]),
                                    Float.parseFloat(getListaInfoRe().get(i)[5]), Float.parseFloat(getListaInfoRe().get(i + 1)[4]), Float.parseFloat(getListaInfoRe().get(i)[6]),
                                    getListaInfoRe().get(i)[7], getListaInfoRe().get(i)[8], fechaA, fechaEA, estado, local, responsable, revision, tipoActivo);

                            //activoFijo.setRotulo(i/*Long.parseLong(getListaInfoRe().get(i)[1]));
                            // activoFijo.setDescripcion(getListaInfoRe().get(i)[2]);
                            //activoFijo.setValorMn(Float.parseFloat(getListaInfoRe().get(i)[3]));
                            //activoFijo.setTasa(Float.parseFloat(getListaInfoRe().get(i)[4]));
                            //activoFijo.setDepAcuMn(Float.parseFloat(getListaInfoRe().get(i)[5]));
                            //activoFijo.setValorActualMn(Float.parseFloat(getListaInfoRe().get(i)[6]));
                            //activoFijo.setResponsableText(getListaInfoRe().get(i)[7]);
                            //activoFijo.setEstadoText(getListaInfoRe().get(i)[8]);
                            //activoFijo.setValorCuc(Float.parseFloat(getListaInfoRe().get(i + 1)[2]));
                            //activoFijo.setDepAcuCuc(Float.parseFloat(getListaInfoRe().get(i + 1)[3]));
                            //activoFijo.setValorActualCuc(Float.parseFloat(getListaInfoRe().get(i + 1)[4]));
                            activoFijoService.create(activoFijo);

                            cantAG++;
                            
                            //if (cantAG == 394) {
                            //    int r = 4;
                            //}

                        //}
                        //else{
                        // JOptionPane.showMessageDialog(null, "Error en el formato del documento." + "\n" +   cantAG + " Activos fijos insertados de" + totalActivos +  "\n"
                        // + "Debe eliminar la última revisión y el último metadata ", "Error", JOptionPane.ERROR_MESSAGE);
                        // break;
                        // }
                    }
                } catch (ArrayIndexOutOfBoundsException excepcion) {
                    JOptionPane.showMessageDialog(null, "Error en el formato del documento." + "\n" + "Activo número: " + (cantAG + 1) + "\n"
                            + "Fila: " + getListaInfoRe().get(cantAG*2)[0], "Error", JOptionPane.ERROR_MESSAGE);
                  
                } catch (ParseException ex) {
                    JOptionPane.showMessageDialog(null, "Error en el formato de fecha." + "\n" + "Activo número: " + (cantAG + 1) + " --- " + "Rotulo: " + getListaInfoRe().get(cantAG*2)[1] + "\n"
                           + "Fila: " + getListaInfoRe().get(cantAG*2)[0] + "\n" + 0 + "  Activos fijos insertados de  " + getListaInfoRe().size() / 2, "Error", JOptionPane.ERROR_MESSAGE);                   
                }

                if (cantAG != getListaInfoRe().size() / 2) {
                    revisionService.removeById(revision.getIdRevision());
                    if (idURev != null) {
                        revision = revisionService.find(idURev);
                        revision.setActivo(true);
                        revisionService.edit(revision);
                    }
                } else {
                    JOptionPane.showMessageDialog(null, cantAG + "  Activos fijos insertados de  " + getListaInfoRe().size() / 2);
                }

            } else {
                JOptionPane.showMessageDialog(null, "Los datos no están completos. Verifique el filtro o el documento", "Error", JOptionPane.ERROR_MESSAGE);
            }
        } else {
            JOptionPane.showMessageDialog(null, "¡Debe cargar el excel primero!", "Información ", JOptionPane.INFORMATION_MESSAGE);
        }
    }
    }
    
    
}

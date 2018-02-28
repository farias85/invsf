/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package cu.cenpis.gps.inv.read;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;
import javax.swing.JOptionPane;
import org.apache.poi.hssf.usermodel.HSSFDateUtil;
import org.apache.poi.hssf.usermodel.HSSFWorkbook;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;

/**
 *
 * @author vladimir
 */
public abstract class Excel {
    
    private List<String[]> listaInfo;
    private List<String[]> listaInfoRe;
    
    private int cantidadC;

    public List<String[]> getListaInfo() {
        return listaInfo;
    }

    public List<String[]> getListaInfoRe() {
        return listaInfoRe;
    }

    public int getCantidadC() {
        return cantidadC;
    }
    
    abstract public void readData();
    abstract  public void crearRevision();

    public Excel() {
        cantidadC = 0;
    }
    
    
    
    public void readExcel(String dir) throws IOException {

        //excelFilePath = dir;
        
        this.listaInfo = new ArrayList<>();
        this.listaInfoRe = new ArrayList<>();
        
        FileInputStream inputStream = null;
        inputStream = new FileInputStream(new File(dir));
        Workbook workbook = null;

        try {
            if (dir.endsWith("xlsx")) {
                workbook = new XSSFWorkbook(inputStream);
            } else {
                workbook = new HSSFWorkbook(inputStream);
            }

            List<String> fila = new ArrayList<>();

            Sheet firstSheet = workbook.getSheetAt(0);
            Iterator<Row> iterator = firstSheet.iterator();
            int i = 1;
            while (iterator.hasNext()) {
                Row nextRow = iterator.next();
                Iterator<Cell> cellIterator = nextRow.cellIterator();

                while (cellIterator.hasNext()) {
                    Cell nextCell = cellIterator.next();
                    fila.add(getValueCell(nextCell).toString().trim());
                }

                fila.add(0, Integer.toString(i));
                cantidadC = Math.max(cantidadC, fila.size());
                String[] miarray = new String[fila.size()];
                miarray = fila.toArray(miarray);
                listaInfo.add(miarray);
                fila = new ArrayList<>();
                i++;
            }

            inputStream.close();
        } catch (Exception e) {
            JOptionPane.showMessageDialog(null, "Formato del Excel 5.0/7.0 (BIFF5) no soportado. Cambiar por BIFF8", "Error", JOptionPane.ERROR_MESSAGE);
        }
    }
    
     private Object getValueCell(Cell cell) {
        switch (cell.getCellType()) {
            case Cell.CELL_TYPE_STRING:
                return cell.getStringCellValue();
            case Cell.CELL_TYPE_NUMERIC:
                if (HSSFDateUtil.isCellDateFormatted(cell)) {
                    SimpleDateFormat dt1 = new SimpleDateFormat("dd/MM/yyyy");
                    return dt1.format(cell.getDateCellValue());
                } else {
                    return Double.toString(cell.getNumericCellValue());
                }
            case Cell.CELL_TYPE_BLANK:
                return " ";
        }
        return null;
    }
     
     public void recortarEcxel(int iF, int fF, int iC, int fC) {

        if (iF > 0 && fF > 0 && iC > 0 && fC > 0) {
            listaInfoRe = new ArrayList<>(listaInfo);
            listaInfoRe = listaInfoRe.subList(0, fF);
            listaInfoRe = listaInfoRe.subList(iF - 1, listaInfoRe.size());

            for (int i = 0; i < listaInfoRe.size(); i++) {
                String[] get = listaInfoRe.get(i);
                String[] nuevo = null;
                if ((fC + 1) > get.length && (iC) <= get.length) {
                    nuevo = new String[get.length - iC + 1];
                    System.arraycopy(get, iC, nuevo, 1, get.length - iC);
                    nuevo[0] = get[0];
                    listaInfoRe.set(i, nuevo);
                } else {
                    if (((fC + 1) <= get.length) && (iC) <= get.length) {
                        nuevo = new String[fC - iC + 2];
                        System.arraycopy(get, iC, nuevo, 1, fC - iC + 1);
                        nuevo[0] = get[0];
                        listaInfoRe.set(i, nuevo);
                    } else {
                        nuevo = new String[1];
                        nuevo[0] = get[0];
                        listaInfoRe.set(i, nuevo);
                    }
                }
            }
        }

    } 
    
}

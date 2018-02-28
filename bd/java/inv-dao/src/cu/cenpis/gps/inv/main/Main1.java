/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package cu.cenpis.gps.inv.main;

import cu.cenpis.gps.inv.data.entity.ActivoFijo;
import cu.cenpis.gps.inv.data.entity.Estado;
import cu.cenpis.gps.inv.data.entity.Local;
import cu.cenpis.gps.inv.data.entity.Responsable;
import cu.cenpis.gps.inv.data.entity.Revision;
import cu.cenpis.gps.inv.data.entity.Usuario;
import cu.cenpis.gps.inv.data.service.ActivoFijoService;
import cu.cenpis.gps.inv.data.service.EstadoService;
import cu.cenpis.gps.inv.data.service.LocalService;
import cu.cenpis.gps.inv.data.service.ResponsableService;
import cu.cenpis.gps.inv.data.service.RevisionService;
import cu.cenpis.gps.inv.data.service.UsuarioService;
import cu.cenpis.gps.inv.security.SecuredPassword;
import java.io.IOException;
import java.security.NoSuchAlgorithmException;
import java.security.spec.InvalidKeySpecException;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import org.springframework.context.ApplicationContext;
import org.springframework.context.support.ClassPathXmlApplicationContext;

/**
 *
 * @author farias-i5
 */
public class Main1 {

    public static void main(String[] args) {
        // TODO code application logic here

        ApplicationContext context = new ClassPathXmlApplicationContext("cu/cenpis/gps/inv/config/mvc-dispatcher-servlet.xml");
        UsuarioService usuarioService = (UsuarioService) context.getBean("usuarioServiceImpl");

        List<Usuario> all = usuarioService.findAll();
        for (int i = 0; i < all.size(); i++) {
            System.out.println(all.get(i).getNombre());
        }
    }
}

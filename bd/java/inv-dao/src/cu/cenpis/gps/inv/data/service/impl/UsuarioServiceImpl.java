package cu.cenpis.gps.inv.data.service.impl;

import cu.cenpis.gps.inv.data.service.UsuarioService;
import cu.cenpis.gps.inv.data.entity.Usuario;
import cu.cenpis.gps.inv.data.dao.UsuarioDAO;
import java.util.List;
import java.util.Objects;

import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

@Service
@Transactional
public class UsuarioServiceImpl extends BaseServiceImpl<Usuario, java.lang.Long, UsuarioDAO>
        implements UsuarioService {

    public UsuarioServiceImpl() {
        System.out.println("UsuarioServiceImpl()");
    }

    @Override
    public Usuario userAuthentication(Usuario u) {
        return dao.userAuthentication(u);
    }

    @Override
    public boolean existe(Usuario usuario) {
        List<Usuario> usuarios = findNamedQuery("Usuario.findByEmail", "email", usuario.getEmail());
        return usuarios.stream().anyMatch((d) -> (d.getEmail().equals(usuario.getEmail()) && !Objects.equals(usuario.getIdUsuario(), d.getIdUsuario())));
    }

    @Override
    public void refrescarSelected(Usuario usuario) {
        Usuario u;
        u = dao.find(usuario.getIdUsuario());
        if (u != null) {
            usuario.setNombre(u.getNombre());
            usuario.setApellidos(u.getApellidos());
            usuario.setEmail(u.getEmail());
            usuario.setContrasenna(u.getContrasenna());
        }
    }
}

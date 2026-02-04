<?php

use App\Models\ActTopic;
use App\Models\AgreementOrigin;
use App\Models\AgreementSituation;
use App\Models\BiddingSituation;
use App\Models\BlankPageType;
use App\Models\DocumentType;
use App\Models\FileType;
use App\Models\Genre;
use App\Models\LegislationAuthor;
use App\Models\MatrialStatus;
use App\Models\NotificationStatus;
use App\Models\NotificationType;
use App\Models\PermissionInformation;
use App\Models\TypeMedia;
use App\Models\TypePost;
use App\Models\TypeRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class DefaultInserts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up(): void
    {

        $roles = [
            [
                'name' => 'Desenvolvedor',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Administrador Master',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Administrador',
                'guard_name' => 'web',
            ]
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver Menu de Desenvolvedor', 'guard_name' => 'web']);
        Role::findByName('Administrador Master')->permissions()->firstOrCreate(['name' => 'Ver Menu Regras e Permissões', 'guard_name' => 'web']);
        Role::findByName('Administrador')->permissions()->firstOrCreate(['name' => 'Ver Menu de Administrador', 'guard_name' => 'web']);
        Role::findByName('Administrador')->permissions()->firstOrCreate(['name' => 'Ver Menu de Ouvidoria', 'guard_name' => 'web']);
        Role::findByName('Administrador')->permissions()->firstOrCreate(['name' => 'Ver Menu de Site', 'guard_name' => 'web']);
        Role::findByName('Administrador')->permissions()->firstOrCreate(['name' => 'Ver Menu de Transparência', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e listar Permissões', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Permissões', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Permissões', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Permissões', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Regras', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Regras', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Regras', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Regras', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Usuários', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Usuários', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Usuários', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Usuários', 'guard_name' => 'web']);

        //administrador
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Pessoas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Pessoas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Pessoas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Pessoas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Documentos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Documentos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Documentos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Documentos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar E-mails', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar E-mails', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar E-mails', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar E-mails', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Telefones', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Telefones', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Telefones', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Telefones', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Departamentos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Departamentos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Departamentos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Departamentos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Unidades', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Unidades', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Unidades', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Unidades', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Endereços', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Endereços', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Endereços', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Endereços', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Ocupações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Ocupações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Ocupações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Ocupações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Notificações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Notificações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Notificações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Notificações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Banners', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Banner', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar FAQs', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar FAQs', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar FAQs', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar FAQs', 'guard_name' => 'web']);
        // Transparência
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Contratos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Contratos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Contratos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Contratos', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Licitações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Licitações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Licitações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Licitações', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Legislações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Legislações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Legislações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Legislações', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Manifestações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Manifestações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Manifestações', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Manifestações', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Despesas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Despesas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Despesas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Despesas', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Receitas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Receitas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Receitas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Receitas', 'guard_name' => 'web']);

        // Site
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Notícias', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Notícias', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Notícias', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Notícias', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Capas do Site', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Capas do Site', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Capas do Site', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Capas do Site', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Banners', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Banner', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar FAQs', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar FAQs', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar FAQs', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar FAQs', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar WebFooter', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar WebFooter', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar WebFooter', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar WebFooter', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar WebFooter', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar WebFooter', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar WebFooter', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar WebFooter', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Copyright', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Copyright', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Copyright', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Copyright', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Shortcut', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Shortcut', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Shortcut', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Shortcut', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Páginas em Branco', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Páginas em Branco', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Páginas em Branco', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Páginas em Branco', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Diário Oficial', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Diário Oficial', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Diário Oficial', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Diário Oficial', 'guard_name' => 'web']);

        $document_types = [
            ['type' => 'CPF'],
            ['type' => 'RG'],
            ['type' => 'PASSAPORTE'],
            ['type' => 'CADASTUR'],
            ['type' => 'RESEXMAR'],
            ['type' => 'CNH'],
            ['type' => 'CNPJ'],
            ['type' => 'INSCRIÇÃO MUNICIPAL'],
            ['type' => 'INSCRIÇÃO ESTADUAL'],
            ['type' => 'SUS o Cartão Nacional de Saúde (CNS)']
        ];

        foreach ($document_types as $document_type) {
            DocumentType::firstOrCreate($document_type);
        }

        $permission_informations = [
            [
                'permission_id' => 1,
                'description' => 'acesso total no sistema'
            ],
            [
                'permission_id' => 2,
                'description' => ' - '
            ],
            [
                'permission_id' => 3,
                'description' => ' - '
            ],
            [
                'permission_id' => 4,
                'description' => ' - '
            ],
            [
                'permission_id' => 5,
                'description' => ' - '
            ],
            [
                'permission_id' => 6,
                'description' => ' - '
            ],
            [
                'permission_id' => 7,
                'description' => ' - '
            ],
            [
                'permission_id' => 8,
                'description' => ' - '
            ],
            [
                'permission_id' => 9,
                'description' => ' - '
            ],
            [
                'permission_id' => 10,
                'description' => ' - '
            ],
            [
                'permission_id' => 11,
                'description' => ' - '
            ],
            [
                'permission_id' => 12,
                'description' => ' - '
            ],
            [
                'permission_id' => 13,
                'description' => ' - '
            ],
            [
                'permission_id' => 14,
                'description' => ' - '
            ],
            [
                'permission_id' => 15,
                'description' => ' - '
            ],
            [
                'permission_id' => 16,
                'description' => ' - '
            ],
            [
                'permission_id' => 17,
                'description' => ' - '
            ],
            [
                'permission_id' => 18,
                'description' => ' - '
            ],
            [
                'permission_id' => 19,
                'description' => ' - '
            ],
            [
                'permission_id' => 20,
                'description' => ' - '
            ],
            [
                'permission_id' => 21,
                'description' => ' - '
            ],
            [
                'permission_id' => 22,
                'description' => ' - '
            ],
            [
                'permission_id' => 23,
                'description' => ' - '
            ],
            [
                'permission_id' => 24,
                'description' => ' - '
            ],
            [
                'permission_id' => 25,
                'description' => ' - '
            ],
            [
                'permission_id' => 26,
                'description' => ' - '
            ],
            [
                'permission_id' => 27,
                'description' => ' - '
            ],
            [
                'permission_id' => 28,
                'description' => ' - '
            ],
            [
                'permission_id' => 29,
                'description' => ' - '
            ],
            [
                'permission_id' => 30,
                'description' => ' - '
            ],
            [
                'permission_id' => 31,
                'description' => ' - '
            ],
            [
                'permission_id' => 32,
                'description' => ' - '
            ],
            [
                'permission_id' => 33,
                'description' => ' - '
            ],
            [
                'permission_id' => 34,
                'description' => ' - '
            ],
            [
                'permission_id' => 35,
                'description' => ' - '
            ],
            [
                'permission_id' => 36,
                'description' => ' - '
            ],
            [
                'permission_id' => 37,
                'description' => ' - '
            ],
            [
                'permission_id' => 38,
                'description' => ' - '
            ],
            [
                'permission_id' => 39,
                'description' => ' - '
            ],
            [
                'permission_id' => 40,
                'description' => ' - '
            ],
            [
                'permission_id' => 41,
                'description' => ' - '
            ],
            [
                'permission_id' => 42,
                'description' => ' - '
            ],
            [
                'permission_id' => 43,
                'description' => ' - '
            ],
            [
                'permission_id' => 44,
                'description' => ' - '
            ]
        ];

        foreach ($permission_informations as $permission_information) {
            PermissionInformation::firstOrCreate($permission_information);
        }

        $genre_types = [
            ['type' => 'Feminino'],
            ['type' => 'Masculino']
        ];

        foreach ($genre_types as $genre_type) {
            Genre::firstOrCreate($genre_type);
        }

        $matrial_status_types = [
            ['type' => 'Solteiro(a)'],
            ['type' => 'Casado(a)'],
            ['type' => 'Viúvo(a)'],
            ['type' => 'Separado(a)'],
            ['type' => 'Divorciado(a)'],
            ['type' => 'União estável'],
            ['type' => 'outro']
        ];

        foreach ($matrial_status_types as $matrial_status_type) {
            MatrialStatus::firstOrCreate($matrial_status_type);
        }

        $notification_statuses = [
            ['status' => 'Visualizado'],
            ['status' => 'Não visualizado'],
            ['status' => 'Confirmado'],
            ['status' => 'Rejeitado'],
            ['status' => 'Armazenado']
        ];

        foreach ($notification_statuses as $notification_status) {
            NotificationStatus::firstOrCreate($notification_status);
        }

        $notification_types = [
            [
                'title' => 'Novidades',
                'active' => 1
            ],
            [
                'title' => 'Atividades da Conta',
                'active' => 1
            ],
            [
                'title' => 'Acessos de novos navegadores',
                'active' => 1
            ]
        ];

        foreach ($notification_types as $notification_type) {
            NotificationType::firstOrCreate($notification_type);
        }

        $type_requests = [
            [
                'title' => 'Denúncia',
                'slug' => 'denuncia'
            ],
            [
                'title' => 'Dúvida',
                'slug' => 'duvida'
            ],
            [
                'title' => 'Elogio',
                'slug' => 'elogio'
            ],
            [
                'title' => 'Outros',
                'slug' => 'outros'
            ],
            [
                'title' => 'Reclamação',
                'slug' => 'reclamacao'
            ],
            [
                'title' => 'Solicitação',
                'slug' => 'solicitacao'
            ],
            [
                'title' => 'Sugestão',
                'slug' => 'sugestao'
            ],
        ];

        foreach ($type_requests as $type_request) {
            TypeRequest::firstOrCreate($type_request);
        }

        $type_posts = [
            [
                'title' => 'banner',
                'slug' => 'banner'
            ],
            [
                'title' => 'new',
                'slug' => 'new'
            ],
            [
                'title' => 'gallery',
                'slug' => 'gallery'
            ]
        ];

        foreach ($type_posts as $type_post) {
            TypePost::firstOrCreate($type_post);
        }

        $type_medias = [
            [
                'title' => 'banner_lg',
                'slug' => 'banner_lg'
            ],
            [
                'title' => 'banner_sm',
                'slug' => 'banner_sm'
            ]
        ];

        foreach ($type_medias as $type_media) {
            TypeMedia::firstOrCreate($type_media);
        }

        $file_types = [
            [
                'title' => 'PDF',
                'slug' => 'pdf'
            ],
            [
                'title' => 'DOC',
                'slug' => 'doc'
            ],
            [
                'title' => 'Excel',
                'slug' => 'excel'
            ],
            [
                'title' => 'Imagem',
                'slug' => 'imagem'
            ],
            [
                'title' => 'Vídeo',
                'slug' => 'video'
            ]
        ];

        foreach ($file_types as $file_type) {
            FileType::firstOrCreate($file_type);
        }

        $legislation_authors = [
            [
                'author' => 'Mesa Direta',
                'active' => 1
            ],
            [
                'author' => 'Comissão',
                'active' => 1
            ],
            [
                'author' => 'Executivo',
                'active' => 1
            ],
            [
                'author' => 'Cidadão',
                'active' => 1
            ],
            [
                'author' => 'Outro',
                'active' => 1
            ]
        ];

        foreach ($legislation_authors as $legislation_author) {
            LegislationAuthor::firstOrCreate($legislation_author);
        }

        $bidding_situations = [
            [
                'title' => 'Aberto',
                'slug' => 'aberto',
                'active' => 1
            ],
            [
                'title' => 'Suspenso',
                'slug' => 'suspenso',
                'active' => 1
            ],
            [
                'title' => 'Anulado',
                'slug' => 'anulado',
                'active' => 1
            ],
            [
                'title' => 'Revogado',
                'slug' => 'Revogado',
                'active' => 1
            ],
            [
                'title' => 'Em Julgamento',
                'slug' => 'Em Julgamento',
                'active' => 1
            ],
            [
                'title' => 'Concluído',
                'slug' => 'Concluído',
                'active' => 1
            ],
            [
                'title' => 'Homologado',
                'slug' => 'Homologado',
                'active' => 1
            ],
            [
                'title' => 'Adiado',
                'slug' => 'Adiado',
                'active' => 1
            ],
            [
                'title' => 'Fracassada',
                'slug' => 'Fracassada',
                'active' => 1
            ],
            [
                'title' => 'Deserta',
                'slug' => 'Deserta',
                'active' => 1
            ],
            [
                'title' => 'Retificado',
                'slug' => 'Retificado',
                'active' => 1
            ],
            [
                'title' => 'Adjudicado',
                'slug' => 'Adjudicado',
                'active' => 1
            ],
            [
                'title' => 'Ratificada',
                'slug' => 'Ratificada',
                'active' => 1
            ],
            [
                'title' => 'Cancelada',
                'slug' => 'Cancelada',
                'active' => 1
            ]
        ];

        foreach ($bidding_situations as $bidding_situation) {
            BiddingSituation::firstOrCreate($bidding_situation);
        }

        $agreement_situations = [
            [
                'title' => 'Aguardando Assinatura',
                'slug' => 'Aguardando Assinatura',
                'active' => 1
            ],
            [
                'title' => 'Vigente',
                'slug' => 'Vigente',
                'active' => 1
            ],
            [
                'title' => 'Suspenso',
                'slug' => 'Suspenso',
                'active' => 1
            ],
            [
                'title' => 'Encerrado',
                'slug' => 'Encerrado',
                'active' => 1
            ],
            [
                'title' => 'Rescindido',
                'slug' => 'Rescindido',
                'active' => 1
            ],
        ];

        foreach ($agreement_situations as $agreement_situation) {
            AgreementSituation::firstOrCreate($agreement_situation);
        }

        $agreement_origins = [
            [
                'title' => 'Licitação',
                'subtitle' => 'LI',
                'slug' => 'licitacao',
                'active' => 1
            ],
            [
                'title' => 'Leilão',
                'subtitle' => 'LE',
                'slug' => 'leilao',
                'active' => 1
            ],
            [
                'title' => 'Dispensa',
                'subtitle' => 'DI',
                'slug' => 'dispensa',
                'active' => 1
            ],
            [
                'title' => 'Inexigibilidade',
                'subtitle' => 'IN',
                'slug' => 'inexigibilidade',
                'active' => 1
            ],
            [
                'title' => 'Credenciamento',
                'subtitle' => 'CR',
                'slug' => 'credenciamento',
                'active' => 1
            ],
            [
                'title' => 'Concessão',
                'subtitle' => 'CO',
                'slug' => 'concessão',
                'active' => 1
            ],
            [
                'title' => 'Outra',
                'subtitle' => 'OU',
                'slug' => 'outra',
                'active' => 1
            ],
        ];

        foreach ($agreement_origins as $agreement_origin) {
            AgreementOrigin::firstOrCreate($agreement_origin);
        }

        $blank_page_types = [
            [
                'title' => 'Institucional',
                'slug' => 'institucional'
            ],
            [
                'title' => 'Serviços',
                'slug' => 'servicos'
            ],
            [
                'title' => 'Link Externo',
                'slug' => 'linkexterno'
            ]
        ];

        foreach ($blank_page_types as $blank_page_type) {
            BlankPageType::firstOrCreate($blank_page_type);
        }



        $act_topics = [
            [
                'title' => 'Poder Executivo',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'COMAP',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'IDAC',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'FIPAC',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'IPC',
                'status' => 'PUBLISHED'
            ],
        ];

        foreach ($act_topics as $act_topic) {
            ActTopic::firstOrCreate($act_topic);
        }

        $act_topics = [
            [
                'act_topic_id' => '1',
                'title' => 'Decretos',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '1',
                'title' => 'Licitações e Contratos',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '1',
                'title' => 'Leis',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '1',
                'title' => 'Portarias',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '1',
                'title' => 'Atos Oficiais',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '1',
                'title' => 'Diversos',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '1',
                'title' => 'Resoluções',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '1',
                'title' => 'Ofícios',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '1',
                'title' => 'Extratos',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '1',
                'title' => 'Concursos / Processos Seletivos',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '2',
                'title' => 'Licitações e Contratos',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '2',
                'title' => 'Portarias',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '3',
                'title' => 'Licitações e Contratos',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '3',
                'title' => 'Portarias',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '3',
                'title' => 'Atos Oficiais',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '3',
                'title' => 'Extratos',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '4',
                'title' => 'Licitações e Contratos',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '4',
                'title' => 'Extratos',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '4',
                'title' => 'Resoluções',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '4',
                'title' => 'Processos Administrativos',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '5',
                'title' => 'Diversos',
                'status' => 'PUBLISHED'
            ],
            [
                'act_topic_id' => '5',
                'title' => 'Portarias',
                'status' => 'PUBLISHED'
            ],
        ];

        foreach ($act_topics as $act_topic) {
            ActTopic::firstOrCreate($act_topic);
        }

        if (!App::environment('production')) {
            Model::withoutEvents(function () {
                User::create([
                        'name' => 'Admin',
                        'email' => 'admin@admin.com',
                        'password' => Hash::make('admin')
                    ]
                );
            });
        }


        if(App::environment('production')) {
            Model::withoutEvents(function () {
                User::create([
                        'name' => 'AdminMaster',
                        'email' => 'admin@admin.com',
                        'password' => Hash::make('@adm1233!')
                    ]
                );
            });
        }

        User::find(1)->syncRoles(Role::all());
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
    }
}

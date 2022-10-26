<?php
namespace App\Entity;

use App\Entity\Contact as EntityContact;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Component\Validator\Constraints as Assert;

class Contact {
    /**
     * @var string|null
     * @Assert\NotBlank
     * @Assert\Length(min=2,max=100)
     */
    private $username;

     /**
     * @var string|null
     * @Assert\NotBlank
     * @Assert\Regex(
     * pattern="/[0-9]{10}/",
     * message= "Invalid phone number"
     * )
     */
    private $phone;

     /**
     * @var string|null
     * @Assert\NotBlank
     * @Assert\Email()
     */
    private $email;
    
    
    /**
     * @var string|null
     * @Assert\NotBlank
     * @Assert\Length(min=10,minMessage ="This value is too short. It should have 10 characters or more.!!!")
     */
    private $message;

	
     
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $Username): self
    {
        $this->username = $Username;

        return $this;
    }

     public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

     public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
    
}